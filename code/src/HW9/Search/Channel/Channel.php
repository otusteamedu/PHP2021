<?php


namespace HW9\Search\Channel;

use HW9\Models\Traits\Channel as ChannelTrait;
use HW9\Search\Search;

class Channel extends Search
{
    use ChannelTrait;

    public function add($channel) : void
    {
        $this->client->index([
            'index' => parent::INDEX_CHANNELS,
            'id' => $channel->getId(),
            'body' => [
                'title' => $channel->getTitle(),
            ],
        ]);
    }

    public function get() : void
    {
        $params = [
            'index' => parent::INDEX_CHANNELS,
            'id' => $this->id,
        ];
        $response = $this->client->getSource($params);

        $this->setTitle($response['title']);
    }
}
