<?php

namespace Elastic\Services;

use Elastic\Models\Video;
use Elastic\Repositories\ElasticSearch\ChannelRepository;
use Elastic\Repositories\ElasticSearch\VideoRepository;
use Elasticsearch\Client;

class Statistics
{
    private Client $esClient;

    public function __construct()
    {
        $this->esClient = (new ESClientService())->getClient();

    }

    public function numberOfLikesForChannel(string $channelId): int
    {
        $params = [
            'index' => Video::INDEX,
            'body' => [
                'query' => [
                    'term' => [
                        'channel_id' => $channelId,
                    ],
                ],
                'aggs' => [
                    'total_likes' => [
                        'sum' => [
                            'field' => 'number_of_likes',
                        ],
                    ],
                ],
            ],
        ];

        return $this->esClient->search($params)["aggregations"]["total_likes"]['value'] ?? 0;
    }

    public function numberOfDislikesForChannel(string $channelId): int
    {
        $params = [
            'index' => Video::INDEX,
            'body' => [
                'query' => [
                    'term' => [
                        'channel_id' => $channelId,
                    ],
                ],
                'aggs' => [
                    'total_likes' => [
                        'sum' => [
                            'field' => 'number_of_dislikes',
                        ],
                    ],
                ],
            ],
        ];

        return $this->esClient->search($params)["aggregations"]["total_likes"]['value'] ?? 0;
    }

    public function getTopChannels (int $numberOfChannels = 10): array
    {
        $params = [
            'index' => Video::INDEX,
            'body' => [
                'size' => $numberOfChannels,
                'aggs' => [
                    "stat" => [
                        'terms' => [
                            'field' => 'channel_id',

                        ],
                        'aggs' => [
                            'total_likes' => [
                                'sum' => [
                                    'field' => 'number_of_likes',
                                ],
                            ],
                            'total_dislikes' => [
                                'sum' => [
                                    'field' => 'number_of_dislikes',
                                ],
                            ],
                            'rating' => [
                                'bucket_script' => [
                                    'buckets_path' => [
                                        'likes' => 'total_likes',
                                        'dislikes' => 'total_dislikes',
                                    ],
                                    'script' => '(params.likes) / (params.dislikes != 0 ? params.dislikes : 1)',
                                ],
                            ],
                            'rating_sort' => [
                                'bucket_sort' => [
                                    'sort' => [
                                        'rating' => [
                                            'order' => 'desc'
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return array_map(
            function ($channel) {
                return [
                    'channelId' => $channel['key'],
                    'rating' => $channel['rating']['value'],
                ];
            },
            $this->esClient->search($params)["aggregations"]['stat']['buckets']
        ) ?? [];
    }
}
