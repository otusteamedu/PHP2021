<?php

namespace HW9\YouTube\Channel;

use Countable;
use Iterator;

class VideoList extends Channel implements Countable, Iterator
{
    public $items = [];
    protected $counter;

    public function retrieveItems($channel_id, $next_page = null) : void
    {
        $params = array(
            'channelId' => $channel_id,
            'maxResults' => parent::SEARCH_LIST_MAX_RESULTS,
        );
        if ($next_page) {
            $params['pageToken'] = $next_page;
        }

        $response = $this->service->search->listSearch('id', $params);

        foreach ($response->items as $video) {
            if ($video['id']->kind === 'youtube#video') {
                $video = new Video($video['id']->videoId);
                $video->setChannelId($channel_id);

                $this->add($video);
            }
        }

        if (!empty($response->nextPageToken)) {
            $this->retrieveItems($channel_id, $response->nextPageToken);
        }
    }

    public function retrieveStatistics() : void
    {
        $ids = [];

        foreach ($this->items as $video_id => $video) {
            $ids[] = $video_id;

            if (count($ids) == parent::SEARCH_LIST_MAX_RESULTS || $video_id == array_key_last($this->items)) {
                $response = $this->service->videos->listVideos('statistics', [
                    'id' => implode(',', $ids),
                ]);

                foreach ($response->items as $item) {
                    $this->items[ $item->id ]->setLikes($item->statistics->likeCount);
                    $this->items[ $item->id ]->setDislikes($item->statistics->dislikeCount);
                }

                $ids = [];
            }
        }
    }


    public function add($item)
    {
        $this->items[ $item->getId() ] = $item;
    }

    public function remove($item)
    {
        $id_to_remove = $item->getId();
        $this->items = array_filter($this->items, function ($item) use ($id_to_remove) {
            return $item->getId() !== $id_to_remove;
        });
    }

    public function current()
    {
        return $this->items[$this->counter];
    }

    public function next()
    {
        $this->counter++;
    }

    public function key()
    {
        return $this->counter;
    }

    public function valid()
    {
        return isset($this->items[$this->counter]);
    }

    public function rewind()
    {
        $this->counter = 0;
    }

    public function count() : int
    {
        return count($this->items);
    }
}
