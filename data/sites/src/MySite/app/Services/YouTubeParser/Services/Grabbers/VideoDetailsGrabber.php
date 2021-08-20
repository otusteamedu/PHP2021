<?php

declare(strict_types=1);

namespace MySite\app\Services\YouTubeParser\Services\Grabbers;


use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Support\Http\UrlBuilder;

/**
 * Class VideoDetailsGrabber
 * @package MySite\app\Services\YouTubeParser\Services\Grabbers
 */
final class VideoDetailsGrabber extends BaseGrabber
{
    /**
     * @return bool
     * @throws GuzzleException
     */
    public function handle(): bool
    {
        $this->url = (new UrlBuilder(getenv('GOOGLE_API_URL')))
            ->joinPart('videos')
            ->joinParam('key', getenv('YOUTUBE_API_KEY'))
            ->joinParam('id', $this->video->id())
            ->joinParam('part', 'snippet,statistics')
            ->url();

        $answer = $this->requestHandle();

        if (isset($answer['items'][0]['snippet'])) {
            $likes = intval($answer['items'][0]['statistics']['likeCount']);
            $dislikes = intval($answer['items'][0]['statistics']['dislikeCount']);
            $this
                ->video
                ->setTitle($answer['items'][0]['snippet']['title'])
                ->setDescription($answer['items'][0]['snippet']['description'])
                ->setPublishedAt($answer['items'][0]['snippet']['publishedAt'])
                ->setChannelId(
                    $this
                        ->channel
                        ->id()
                );
            $this
                ->channel
                ->addLikes($likes)
                ->addDislikes($dislikes);
        }
        return parent::handle();
    }
}
