<?php

namespace HW9\YouTube\Channel;

use HW9\YouTube\YouTube;

use HW9\Models\Traits\Channel as ChannelTrait;

class Channel extends YouTube
{
    use ChannelTrait;

    public function retrieveTitle() : void
    {
        $r = $this->service->channels->listChannels('snippet', array(
            'id' => $this->id,
        ));
        $this->setTitle($r->items[0]->snippet->title);
    }

    public function retrieveVideos() : void
    {
        $this->video_list = new VideoList();
        $this->video_list->setService($this->service);
        $this->video_list->retrieveItems($this->id);
        $this->video_list->retrieveStatistics();
    }

    public function countStatistics() : void
    {
        foreach ($this->video_list->items as $video) {
            $this->addLikes($video->getLikes());
            $this->addDislikes($video->getDislikes());
        }
    }
}
