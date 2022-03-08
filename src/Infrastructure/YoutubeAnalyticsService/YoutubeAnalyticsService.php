<?php

namespace App\Infrastructure\YoutubeAnalyticsService;

use App\Application\YoutubeEsRepositoryInterface;
use App\DTO\YoutubeChannelStats;
use Exception;

class YoutubeAnalyticsService
{
    private YoutubeEsRepositoryInterface $repository;
    private array $totalLikesViewsByChannelStatement;
    private array $topChannelsWithMaxLikesViewsPercentageStatement;

    /**
     * @param YoutubeEsRepositoryInterface $repository
     *
     * @throws Exception
     */
    public function __construct(YoutubeEsRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $statement = json_decode(
            file_get_contents(
                __DIR__ . '/total_likes_views_by_channel_statement.json'
            ),
            true
        );
        if (is_null($statement)) {
            throw new Exception(
                'total likes views by channel statement is not found'
            );
        }
        $this->totalLikesViewsByChannelStatement = $statement;

        $statement = json_decode(
            file_get_contents(
                __DIR__ . '/top_channels_with_max_likes_views_percentage_statement.json'
            ),
            true
        );
        if (is_null($statement)) {
            throw new Exception(
                'top channels with max likes views percentage statement is not found'
            );
        }
        $this->topChannelsWithMaxLikesViewsPercentageStatement = $statement;
    }

    /**
     * @param string $channelId
     *
     * @return YoutubeChannelStats
     */
    public function getTotalLikesViewsByChannel(string $channelId = ''
    ): YoutubeChannelStats {
        $this->totalLikesViewsByChannelStatement['query']['match']['id'] =
            $channelId;

        $result = $this->repository->search(
            $this->totalLikesViewsByChannelStatement
        );

        return new YoutubeChannelStats(
            $channelId,
            $result['aggregations']['videos']['total_views']['value'],
            $result['aggregations']['videos']['total_likes']['value']
        );
    }

    /**
     * @param int $maxChannels
     *
     * @return YoutubeChannelStats[]
     */
    public function getTopChannelsWithMaxLikesViewsPercentage(int $maxChannels
    ): array {
        $this->topChannelsWithMaxLikesViewsPercentageStatement['aggs']['youtube_channel_total_stats']['aggs']['final_sort']['bucket_sort']['size'] =
            $maxChannels;

        $result = $this->repository->search(
            $this->topChannelsWithMaxLikesViewsPercentageStatement
        );

        return array_map(
            fn($item) => new YoutubeChannelStats(
                $item['key'],
                $item['videos']['total_views']['value'],
                $item['videos']['total_likes']['value'],
                $item['likes_to_views_percentage']['value']
            ),
            $result['aggregations']['youtube_channel_total_stats']['buckets'] ??
            []
        );
    }
}
