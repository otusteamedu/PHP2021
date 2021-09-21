<?php

namespace App\Services\Youtube\Repositories\Statistics\Elasticsearch;

use App\Services\Youtube\Repositories\Statistics\TopStatistics;

final class ElasticsearchTopStatistics extends ElasticsearchStatistics implements TopStatistics
{

    public function get(int $limit = 0): array
    {
        $result = $this->elasticsearch->search([
            'index' => $this->model->getSearchIndex(),
            'type' => $this->model->getSearchType(),
            'body' => $this->getSearchRequestBody($limit),
        ]);

        return $this->formatData($result);
    }

    protected function formatData(array $inputArray): array
    {
        $returnValue = [];
        foreach ($inputArray['aggregations']['channel_name_agg']['buckets'] as $row) {
            $returnValue[] = (object)[
                'title' => $row['key'],
                'value' => $row['value']['value'],
            ];
        }

        return $returnValue;
    }

    private function getSearchRequestBody(int $limit = 1): array
    {
        $body = [
            'size' => 0,
            'aggs' => [
                'channel_name_agg' => [
                    'terms' => [
                        'field' => 'channel_name.keyword',
                    ],
                    'aggs' => [
                        'total_likes' => [
                            'sum' => [
                                'field' => 'likes',
                            ]
                        ],
                        'total_dislikes' => [
                            'sum' => [
                                'field' => 'dislikes',
                            ]
                        ],
                        'value' => [
                            'bucket_script' => [
                                'buckets_path' => [
                                    'totalLikes' => 'total_likes',
                                    'totalDislikes' => 'total_dislikes',
                                ],
                                'script' => 'params.totalLikes/params.totalDislikes'
                            ],
                        ],
                        'sales_bucket_sort' => [
                            'bucket_sort' => [
                                'sort' => [
                                    'value' => [
                                        'order' => 'desc',
                                    ]
                                ],
                                'size' => $limit,
                            ]
                        ],
                    ],
                ],
            ],
        ];
        return $body;
    }
}
