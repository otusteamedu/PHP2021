<?php

namespace App;

class StatisticsManager
{
    private $storageInterface;

    public function __construct($storageInterface)
    {
        $this->storageInterface = $storageInterface;
    }

    public function getSummary($request)
    {
        $arSummary = [];

        $arChannelData = $this->storageInterface->search(
            [
                'index' => 'youtube_channel',
                'body' => [
                    'query' => [
                        'match' => [
                            'channel_name' => $request['name']
                        ]
                    ]
                ]
            ]
        );

        foreach ($arChannelData as $channel) {
            $arSummary[$channel['_id']] = $channel;
            $arSummary[$channel['_id']]['videos'] = $this->getAllChanelVideos($channel['_id']);
        }

        return $arSummary;
    }

    public function getAllChanelVideos($id)
    {
        return $this->storageInterface->search(
            [
                'index' => 'youtube_video',
                'body' => [
                    'query' => [
                        'match' => [
                            'channel_id' => $id
                        ]
                    ]
                ]
            ]
        );
    }

    public function getTopRatedChannels()
    {
        $arRate = [];
        $arChannels = $this->getAllChannels();

        foreach ($arChannels as $channel) {
            $arVideos = $this->getAllChanelVideos($channel['_id']);

            foreach ($arVideos as $video) {
                $arRate[$channel['_source']['channel_name']] += $video['_source']['likes'];
            }
        }

        arsort($arRate, SORT_NUMERIC);

        return $arRate;
    }

    public function getAllChannels()
    {
        return $this->storageInterface->search(
            [
                'index' => 'youtube_channel'
            ]
        );
    }
}
