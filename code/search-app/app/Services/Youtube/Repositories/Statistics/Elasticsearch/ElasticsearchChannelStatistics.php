<?php

namespace App\Services\Youtube\Repositories\Statistics\Elasticsearch;

use App\Services\Youtube\Repositories\Statistics\ChannelStatistics;

final class ElasticsearchChannelStatistics extends ElasticsearchStatistics implements ChannelStatistics
{

    public function get(string $query = ''): array
    {
        $result = $this->elasticsearch->search([
            'index' => $this->model->getSearchIndex(),
            'type' => $this->model->getSearchType(),
            'body' => $this->getSearchRequestBody($query),
        ]);

        return $this->formatData($result);
    }

    protected function formatData(array $inputArray): array
    {
        $returnValue = [];
        foreach ($inputArray['aggregations']['channel_name_agg']['buckets'] as $row) {
            $returnValue[] = (object)[
                'title' => $row['key'],
                'value' => $row['total_likes']['value'] . ' / ' . $row['total_dislikes']['value'],
            ];
        }

        return $returnValue;
    }

    private function getSearchRequestBody(string $query = ''): array
    {
        $body = [
            'size' => 0,
        ];
        if (!empty($query)) {
            $body['query'] = [
                'match' => [
                    'channel_name' => $query
                ]
            ];
        }
        $body['aggs'] = [
            'channel_name_agg' => [
                'terms' => [
                    'field' => 'channel_name.keyword',
                ],
                'aggs' => [
                    'total_likes' => [
                        'sum' => [
                            'field' => 'likes',
                        ],
                    ],
                    'total_dislikes' => [
                        'sum' => [
                            'field' => 'dislikes',
                        ],
                    ],
                ],
            ],
        ];
        return $body;
    }

}
