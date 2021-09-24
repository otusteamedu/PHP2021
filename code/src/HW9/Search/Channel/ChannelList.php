<?php


namespace HW9\Search\Channel;

use HW9\Search\Search;
use HW9\YouTube\Channel\Channel;

class ChannelList extends Search
{
    public $items = [];

    public function get()
    {
        if (empty($this->items)) {
            $params = [
                'index' => parent::INDEX_CHANNELS,
                'body'  => [
                    'query' => [
                        'match_all' => new \stdClass()
                    ]
                ]
            ];

            $response = $this->client->search($params);

            foreach ($response['hits']['hits'] as $hit) {
                $channel = new Channel();
                $channel->setId($hit['_id']);
                $channel->setTitle($hit['_source']['title']);

                $this->items[] = $channel;
            }
        }
    }
}
