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

        $items = $this->elasticsearch->search([
            "size" => 0,
            'type' => $model->getSearchType(),
            'body' => [
                'aggs' => [
                    'video_channel_agg' => [
                        'terms' => [
                            'field' => 'channel',
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
                            ],
                        ],
//                        'value' => [
//                            'bucket_script' => [
//                                'buckets_path' => [
//                                    'sum_likes' => 'sum_likes',
//                                    'sum_dislikes' => 'sum_dislikes',
//                                ],
//                                'script' => 'params.sum_likes/params.sum_dislikes'
//                            ]
//                        ]

                    ],

                ]
            ]
        ]);

        return $this->buildCollection($items);
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
}
