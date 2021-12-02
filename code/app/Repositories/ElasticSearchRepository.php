<?php

namespace App\Repositories;

use App\Models\Video;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class ElasticSearchRepository
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = '')
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    public function searchTop()
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
        return $this->buildBucketsCollection($items, 'video_channel_agg');
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
        return collect($items['hits']['hits'])->map(function ($video) {
            return $video['_source'];
        });
    }

    private function buildBucketsCollection(array $items, $aggrname)
    {
        return collect($items['aggregations'][$aggrname]['buckets'])
            ->mapWithKeys(function ($channel) {
            return [$channel['key'] => [
                'difference' => $channel['sum_likes']['value'] / $channel['sum_dislikes']['value']]
            ];
        })
            ->sortByDesc('difference')
            ->take(5)
            ->keys();
    }
}
