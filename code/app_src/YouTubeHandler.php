<?php

namespace App;

use Google;

class YouTubeHandler
{
    private $client;
    private $YouTube;

    public function __construct()
    {
        $this->client = new Google\Client();

        $this->client->setApplicationName('YouTubeStorage');
        $this->client->setDeveloperKey('AIzaSyDgkGOeEZiV_Z-XFLCTxTHQqeub4-cSSaw');

        $this->YouTube = new Google\Service\YouTube($this->client);
    }

    public function getYouTubeChannelData($channelName)
    {
        $channelData = $this->YouTube->search->listSearch('id,snippet', [
            'q' => $channelName
        ]);

        return $channelData['items'];
    }

    public function getVideoLikes($videoId)
    {
        $arVideoStatistic = $this->YouTube->videos->listVideos('statistics', [
            'id' => $videoId,
        ]);

        return $arVideoStatistic->items[0]->statistics->likeCount;
    }
}
