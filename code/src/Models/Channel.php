<?php

namespace Models;

class Channel
{
    private $id;
    private $uploads;
    private $subscriberCount;
    private $videoCount;
    private $viewCount;

    public $index = 'channels';
    public $schemaChannels = [
        'index' => 'channels',
        'body' => [
            'mappings' => [
                'properties' => [
                    'id' => [
                        'type' => 'text'
                    ],
                    'uploads' => [
                        'type' => 'text'
                    ],
                    'subscriberCount' => [
                        'type' => 'integer'
                    ],
                    'videoCount' => [
                        'type' => 'integer'
                    ],
                    'viewCount' => [
                        'type' => 'integer'
                    ]
                ],
            ],
        ],
    ];

    public function __construct($channelsData)
    {
        $this->id = $channelsData->items[0]->id;
        $this->uploads = $channelsData->items[0]->contentDetails->relatedPlaylists->uploads;
        $this->subscriberCount = $channelsData->items[0]->statistics->subscriberCount;
        $this->videoCount = $channelsData->items[0]->statistics->videoCount;
        $this->viewCount = $channelsData->items[0]->statistics->viewCount;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUploads($uploads)
    {
        $this->uploads = $uploads;
    }

    public function getUploads()
    {
        return $this->uploads;
    }

    public function setSubscriberCount($subscriberCount)
    {
        $this->subscriberCount = $subscriberCount;
    }

    public function getSubscriberCount()
    {
        return $this->subscriberCount;
    }

    public function setVideoCount($videoCount)
    {
        $this->videoCount = $videoCount;
    }

    public function getVideoCount()
    {
        return $this->videoCount;
    }

    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;
    }

    public function getViewCount()
    {
        return $this->viewCount;
    }

}