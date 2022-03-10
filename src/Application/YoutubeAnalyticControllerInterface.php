<?php

namespace App\Application;

use App\DTO\Response;

interface YoutubeAnalyticControllerInterface
{
    public const PATH = '/api/v1/youtube/analyze';

    public function getTotalLikesViewsByChannel(string $id): Response;

    public function getTopChannelsWithMaxLikesViewsPercentage(): Response;
}
