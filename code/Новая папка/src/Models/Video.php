<?php

namespace Elastic\Models;

class Video
{
    private $id;
    private $channels_id;
    private $title;
    private $viewCount;
    private $likeCount;
    private $dislikeCount;

    public $index = 'video';
    public $schema = [
        'index' => $this->index,
        'body' => [
        'mappings' => [
            'properties' => [
                'id' => [
                    'type' => 'text',
                ],
                'channels_id' => [
                    'type' => 'text',
                ],
                'title' => [
                    'type' => 'text',
                ],
                'viewCount' => [
                    'type' => 'integer',
                ],
                'likeCount' => [
                    'type' => 'integer',
                ],
                'dislikeCount' => [
                    'type' => 'integer'
                ],
            ],
        ],
    ];

    public function __construct($videoData)
    {
        $this->id = $videoData['id'];
        $this->channels_id = $videoData['channels_id'];
        $this->title = $videoData['title'];
        $this->viewCount = $videoData['viewCount'];
        $this->likeCount = $videoData['likeCount'];
        $this->dislikeCount = $videoData['dislikeCount'];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
   
    public function setChannels_id($channels_id)
    {
        $this->channels_id = $channels_id;
    }

    public function getChannels_id()
    {
        return $this->channels_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;
    }

    public function getViewCount()
    {
        return $this->viewCount;
    }
    
    public function setLikeCount($likeCount)
    {
        $this->likeCount = $likeCount;
    }

    public function getLikeCount()
    {
        return $this->likeCount;
    }

    public function setDislikeCount($dislikeCount)
    {
        $this->dislikeCount = $dislikeCount;
    }

    public function getDislikeCount()
    {
        return $this->dislikeCount;
    }
}