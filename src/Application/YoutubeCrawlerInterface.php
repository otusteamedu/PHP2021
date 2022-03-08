<?php

namespace App\Application;

use App\Domain\YoutubeChannel;

interface YoutubeCrawlerInterface
{
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
    ): array;
}
