<?php

namespace App\Application;

use App\DTO\YoutubeChannelStats;

interface YoutubeAnalyticsServiceInterface
{
    public function getTotalLikesViewsByChannel(string $channelId = ''): YoutubeChannelStats;

    public function getTopChannelsWithMaxLikesViewsPercentage(int $maxChannels): array;
}
