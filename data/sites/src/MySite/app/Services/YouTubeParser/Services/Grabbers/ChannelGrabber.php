<?php

declare(strict_types=1);

namespace MySite\app\Services\YouTubeParser\Services\Grabbers;


use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Support\Http\UrlBuilder;

/**
 * Class ChannelGrabber
 * @package MySite\app\Services\YouTubeParser\Services\Grabbers
 */
final class ChannelGrabber extends BaseGrabber
{

    /**
     * @return bool
     * @throws GuzzleException
     */
    public function handle(): bool
    {
        $this->url = (new UrlBuilder(getenv('GOOGLE_API_URL')))
            ->joinPart('channels')
            ->joinParam('key', getenv('YOUTUBE_API_KEY'))
            ->joinParam('id', $this->channel->id())
            ->joinParam('part', 'snippet')
            ->url();

        $answer = $this->requestHandle();

        if (isset($answer['items'])) {
            $this
                ->channel
                ->setTitle($answer['items'][0]['snippet']['title'])
                ->setDescription($answer['items'][0]['snippet']['description'])
                ->setPublishedAt($answer['items'][0]['snippet']['publishedAt']);
        }
        return parent::handle();
    }
}
