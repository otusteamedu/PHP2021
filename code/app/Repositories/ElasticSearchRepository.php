<?php

namespace App\Repositories;

use App\Models\Video;
use Elasticsearch\Client;

class ElasticSearchRepository
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function searchSumOfGrades(string $query = '')
    {
        $model = new Video();

        $items = $this->elasticsearch->search([
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    "match" => [
                        "channel" => $query
                    ]
                ],
                'aggs' => [
                    'sum_likes' => [
                        'sum' => [
                            'field' => 'likes',
                        ],
                    ],
                    'sum_dislikes' => [
                        'sum' => [
                            'field' => 'dislikes',
                        ]
                    ]
                ],
            ],
        ]);
        return $this->buildSumCollection($items);
    }

    public function searchTop($limit)
    {
        $model = new Video();

        $items = $this->elasticsearch->search(
            [
                'type' => $model->getSearchType(),
                'body' => [
                    'aggs' => [
                        'video_channel_agg' => [
                            'terms' => [
                                'field' => 'channel.keyword',
                            ],
                            'aggs' => [
                                'sum_likes' => [
                                    'sum' => [
                                        'field' => 'likes',
                                    ],
                                ],
                                'sum_dislikes' => [
                                    'sum' => [
                                        'field' => 'dislikes',
                                    ]
                                ]
                            ],
                        ]
                    ]
                ]
            ]
        );
        return $this->buildBucketsDifferenceCollection($items, $limit);
    }

    private function buildSumCollection(array $items)
    {
        return collect($items['aggregations'])
            ->mapWithKeys(function ($value, $key) {
                return [$key => $value['value']];
            });
    }

    private function buildBucketsDifferenceCollection(array $items, $limit)
    {
        return collect($items['aggregations']['video_channel_agg']['buckets'])
            ->mapWithKeys(function ($channel) {
            return [$channel['key'] => [
                'difference' => $channel['sum_likes']['value'] / $channel['sum_dislikes']['value']]
            ];
        })
            ->sortByDesc('difference')
            ->take($limit)
            ->keys();
    }
}
