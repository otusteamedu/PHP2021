<?php

declare(strict_types=1);

namespace MySite\app\Services\YouTubeParser\Services\Grabbers;


use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Support\Entities\YouTubeVideo;
use MySite\app\Support\Http\UrlBuilder;

/**
 * Class ChannelDetailsGrabber
 * @package MySite\app\Services\YouTubeParser\Services\Grabbers
 */
final class ChannelDetailsGrabber extends BaseGrabber
{
    /**
     * @return bool
     * @throws GuzzleException
     */
    public function handle(): bool
    {
        $this->url = (new UrlBuilder(getenv('GOOGLE_API_URL')))
            ->joinPart('search')
            ->joinParam('key', getenv('YOUTUBE_API_KEY'))
            ->joinParam('channelId', $this->channel->id())
            ->joinParam('maxResults', getenv('YOUTUBE_MAX_RESULTS'))
            ->joinParam('part', 'snippet')
            ->joinParam('pageToken', $this->nextPageToken)
            ->url();

        $answer = $this->requestHandle();

        $this->nextPageToken = $answer['nextPageToken'] ?? null;

        if (isset($answer['items'])) {
            foreach ($answer['items'] as $item) {
                if (isset($item['id']['videoId'])) {
                    $this->channel->addVideo(
                        new YouTubeVideo($item['id']['videoId'])
                    );
                }
            }
        }
        return parent::handle();
    }
}
