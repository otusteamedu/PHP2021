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
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
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
        return $this->buildBucketsCollection($items, $limit);
    }

    private function searchOnElasticsearch(string $query = ''): array
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
            ],
        ]);
        return $items;
    }


    private function buildCollection(array $items)
    {
        $videos = collect($items['hits']['hits'])->map(function ($video) {
            return $video['_source'];
        });
        $likesSum = $videos->sum(function ($video) {
            return $video['likes'];
        });
        $dislikesSum = $videos->sum(function ($video) {
            return $video['dislikes'];
        });
        return [
            'likes' => $likesSum,
            'dislikes' => $dislikesSum,
        ];
    }

    private function buildBucketsCollection(array $items, $limit)
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
