<?php

namespace Elastic\Models;

class Channels
{
    private $id;
    private $uploads;
    private $subscriberCount;
    private $videoCount;
    private $viewCount;

    public $index = 'channels';
    public  $schema = [
        'index' => $this->index,
        'body' => [
            'mappings' => [
                'properties' => [
                    'id' => [
                        'type' => 'text',
                    ],
                    'uploads' => [
                        'type' => 'text',
                    ],
                    'subscriberCount' => [
                        'type' => 'integer',
                    ],
                    'videoCount' => [
                        'type' => 'integer',
                    ],
                    'viewCount' => [
                        'type' => 'integer',
                    ]
                ],
            ],
        ],
    ];

    public function __construct($channelsData)
    {
        $this->id = $channelsData['id'];
        $this->uploads = $channelsData['uploads'];
        $this->subscriberCount = $channelsData['subscriberCount'];
        $this->videoCount = $channelsData['videoCount'];
        $this->viewCount = $channelsData['viewCount'];
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