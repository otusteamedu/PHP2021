<?php


namespace HW9\Search\Statistics;

class Channel extends Statistics
{
    public function getSum($id_channel) : array
    {
        $params = [
            'index' => parent::INDEX_VIDEOS,
            'body'  => [
                'aggs' => [
                    'sum_for_channel' => [//agg name
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
                                ],
                            ],
                        ],
                    ],
                ],
                'query' => [
                    'match' => [
                        'channel' => $id_channel,
                    ]
                ],
            ],
        ];

        $response = $this->client->search($params);

        $sums = array(
            'likes' => (int) $response['aggregations']['sum_for_channel']['buckets'][0]['sum_likes']['value'],
            'dislikes' => (int) $response['aggregations']['sum_for_channel']['buckets'][0]['sum_dislikes']['value'],
        );

        return $sums;
    }

    public function show($channel) : void
    {
        echo 'Statistics for channel "' . $channel->getTitle() . '"' . "\r\n";
        echo 'Likes: ' . $channel->getLikes() . "\r\n";
        echo 'Dislikes: ' . $channel->getDislikes() . "\r\n";
    }
}
