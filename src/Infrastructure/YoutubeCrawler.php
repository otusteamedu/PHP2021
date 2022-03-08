<?php

namespace App\Infrastructure;

use App\Application\YoutubeCrawlerInterface;
use App\Domain\YoutubeChannel;
use App\Domain\YoutubeVideo;
use Google_Service_YouTube;

class YoutubeCrawler implements YoutubeCrawlerInterface
{
    private Google_Service_YouTube $service;

    /**
     * @param Google_Service_YouTube $service
     */
    public function __construct(Google_Service_YouTube $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $query
     * @param string $topicId
     * @param int    $maxChannels
     * @param int    $maxVideosByChannel
     *
     * @return YoutubeChannel[]
     */
    public function getChannelsCollection(
        string $query,
        string $topicId,
        int $maxChannels,
        int $maxVideosByChannel
    ): array {
        $result = $this->service->search->listSearch(
            'snippet',
            [
                'type'       => 'channel',
                'q'          => $query,
                'topicId'    => $topicId,
                'maxResults' => $maxChannels,
            ]
        );

        return array_map(
            fn($item) => new YoutubeChannel(
                [
                    'id'     => $item->getSnippet()
                                     ->getChannelId(),
                    'title'  => $item->getSnippet()
                                     ->getChannelTitle(),
                    'videos' => $this->getChannelVideos(
                        $item->getId()
                             ->getChannelId(),
                        $maxVideosByChannel
                    ),
                ],
            ),
            $result->getItems()
        );
    }

    /**
     * @param string $channelId
     * @param int $maxVideosByChannel
     *
     * @return array
     */
    private function getChannelVideos(
        string $channelId,
        int $maxVideosByChannel
    ): array {
        $searchResult = $this->service->search->listSearch(
            'snippet',
            [
                'channelId'  => $channelId,
                'maxResults' => $maxVideosByChannel,
            ]
        );

        $items = array_filter(
            $searchResult->getItems(),
            fn($item) => $item->getId()
                              ->getVideoId() !== null
        );
        $videoIds = array_map(
            fn($item) => $item->getId()
                              ->getVideoId(),
            $items
        );
        $videoResult = $this->service->videos->listVideos(
            'snippet,statistics',
            ['id' => $videoIds]
        );

        return array_map(
            fn($item) => [
                'id'         => $item->getId(),
                'title'      => $item->getSnippet()
                                     ->getTitle(),
                'view_count' => $item->getStatistics()
                                     ->getViewCount() ?? 0,
                'like_count' => $item->getStatistics()
                                     ->getLikeCount() ?? 0,
            ],
            $videoResult->getItems()
        );
    }
}
