<?php

declare(strict_types=1);

namespace MySite\app\Services\YouTubeParser;

use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Services\AbstractService;
use MySite\app\Services\YouTubeParser\Exceptions\YouTubeParserExceptions;
use MySite\app\Services\YouTubeParser\Services\Grabbers\ChannelDetailsGrabber;
use MySite\app\Services\YouTubeParser\Services\Grabbers\ChannelGrabber;
use MySite\app\Services\YouTubeParser\Services\Grabbers\VideoDetailsGrabber;
use MySite\app\Support\Entities\YouTubeChannel;

/**
 * Class App
 * @package MySite\app\Services\YouTubeParser
 */
final class YouTubeParserService extends AbstractService
{
    /**
     * @return YouTubeChannel
     * @throws GuzzleException
     * @throws \Exception
     */
    public function run(): YouTubeChannel
    {
        if (!isset($this->queryParams['channel'])) {
            YouTubeParserExceptions::noChannel();
        }

        $channel = trim($this->queryParams['channel']);

        $youTubeChannelDTO = new YouTubeChannel($channel);

        (new ChannelGrabber())
            ->setChannel($youTubeChannelDTO)
            ->handle();

        (new ChannelDetailsGrabber())
            ->setChannel($youTubeChannelDTO)
            ->handle();

        foreach ($youTubeChannelDTO->videos() as $video) {
            (new VideoDetailsGrabber())
                ->setChannel($youTubeChannelDTO)
                ->setVideo($video)
                ->handle();
        }

        return $youTubeChannelDTO;
    }
}
