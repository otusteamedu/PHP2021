<?php

namespace HW9\Models\Traits;

use HW9\YouTube\Channel\VideoList;

trait Channel
{
    protected $id = null;
    private ?string $title = null;
    protected int $likes = 0;
    protected int $dislikes = 0;
    public VideoList $video_list;

    public function __construct(string $link = null)
    {
        if (!empty($link)) {
            $this->setIdFromLink($link);
        }
    }

    private function setIdFromLink(string $link) : void
    {
        $this->id = end(explode('/', $link));
    }
    public function setId(string $id) : void
    {
        $this->id = $id;
    }

    public function getId() : string
    {
        return $this->id;
    }
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setLikes(int $num) : void
    {
        $this->likes = $num;
    }
    public function addLikes(int $num) : void
    {
        $this->likes += $num;
    }

    public function getLikes() : string
    {
        return $this->likes;
    }
    public function setDislikes(int $num) : void
    {
        $this->dislikes = $num;
    }
    public function addDislikes(int $num) : void
    {
        $this->dislikes += $num;
    }

    public function getDislikes() : string
    {
        return $this->dislikes;
    }
}
