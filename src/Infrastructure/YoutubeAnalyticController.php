<?php

namespace App\Infrastructure;

use App\Application\YoutubeAnalyticControllerInterface;
use App\Application\YoutubeAnalyticsServiceInterface;
use App\DTO\Response;
use Exception;

class YoutubeAnalyticController implements YoutubeAnalyticControllerInterface
{
    private YoutubeAnalyticsServiceInterface $service;

    /**
     * @param YoutubeAnalyticsServiceInterface $service
     */
    public function __construct(YoutubeAnalyticsServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @throws Exception
     */
    public function getTotalLikesViewsByChannel(string $id): Response
    {
        $stats = $this->service->getTotalLikesViewsByChannel($id);

        return new Response(
            json_encode($stats->toArray(), JSON_PRETTY_PRINT), 200
        );
    }

    /**
     * @throws Exception
     */
    public function getTopChannelsWithMaxLikesViewsPercentage(): Response
    {
        $stats = $this->service->getTopChannelsWithMaxLikesViewsPercentage(
            $_GET['limit'] ?? 5
        );

        return new Response(
            json_encode(
                array_map(fn($item) => $item->toArray(), $stats),
                JSON_PRETTY_PRINT
            ), 200
        );
    }
}
