<?php

namespace HW9\Search\Statistics;

use HW9\Search\Channel\Channel;
use HW9\Search\Search;

class Statistics extends Search
{
    private $limit = 3;

    public function setLimit(int $limit) : void
    {
        $this->limit = $limit;
    }

    public function top() : array
    {
        $params = [
            'index' => parent::INDEX_VIDEOS,
            'body'  => [
                'aggs' => [
                    'sum_for_channel' => [//agg name
                        'terms' => [
                            'field' => 'channel',
                            'size' => $this->limit,
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
                                ],
                            ],
                            'ratio' => [
                                'bucket_script' => [
                                    'buckets_path' => [
                                        'var_likes' => 'sum_likes',
                                        'var_dislikes' => 'sum_dislikes',
                                    ],
                                    'script' => 'params.var_dislikes / params.var_likes',
                                ],
                            ],
                            'sort_by_ratio' => [
                                'bucket_sort' => [
                                    'sort' => [
                                        'ratio' => [
                                            'order' => 'asc',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        
        
        $response = $this->client->search($params);
        
        $ratios = array();
        foreach ($response['aggregations']['sum_for_channel']['buckets'] as $bucket) {
            $ratios[] = array(
                'id_channel' => $bucket['key'],
                'ratio' => $bucket['ratio']['value'],
            );
        }
        
        return $ratios;
    }
    

    public function showTop(array $top_result) : void
    {
        foreach ($top_result as $place => $hit) {
            $channel = new Channel();
            $channel->setClient($this->client);
            $channel->setId($hit['id_channel']);
            $channel->get();

            echo 'Place #' . ($place + 1) . ': ' . $channel->getTitle() . ', ratio ' . $hit['ratio'] . "\r\n";
        }
    }
}
