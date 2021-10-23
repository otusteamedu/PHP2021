<?php

namespace Models;

class Video
{
    private $id;
    private $channels_id;
    private $title;
    private $viewCount;
    private $likeCount;
    private $dislikeCount;

    public $index = 'video';
    public $schemaVideo = [
        'index' => 'video',
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
        ],
    ];

    public function __construct($videoData)
    {
        $this->id = $videoData->items[0]->id;
        $this->channelsId = $videoData->items[0]->snippet->channelId;
        $this->title = $videoData->items[0]->snippet->title;
        $this->viewCount = $videoData->items[0]->statistics->viewCount;
        $this->likeCount = $videoData->items[0]->statistics->likeCount;
        $this->dislikeCount = $videoData->items[0]->statistics->dislikeCount;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
   
    public function setChannelsId($channelsId)
    {
        $this->channelsId = $channelsId;
    }

    public function getChannelsId()
    {
        return $this->channelsId;
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