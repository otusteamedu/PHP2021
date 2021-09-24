<?php


namespace HW9\Search\Channel;

use HW9\Models\Traits\Video as VideoTrait;

class Video extends Channel
{
    use VideoTrait;

    public function add($video) : void
    {
        $this->client->index([
            'index' => parent::INDEX_VIDEOS,
            'id' => $video->getId(),
            'body' => [
                'channel' => $video->getChannelId(),
                'likes' => $video->getLikes(),
                'dislikes' => $video->getDislikes(),
            ],
        ]);
    }
}
