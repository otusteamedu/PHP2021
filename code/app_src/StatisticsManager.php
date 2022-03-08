<?php

namespace App;

class StatisticsManager
{
    private $storageInterface;

    public function __construct($storageInterface)
    {
      $this->storageInterface = $storageInterface;
    }

    public function getChannelSummary($channelId)
    {
      $arChannelVideos = $this->storageInterface->search(
        [
          'index' => 'youtube_video',
          'body' => [
            'query' => [
              'match' => [
                'channel_id' => $channelId
              ]
            ]
          ]
        ]
      );

      $likesCount = 0;
      $dislikesCount = 0;
      foreach ($arChannelVideos as $singleVideo) {
        $likesCount += $singleVideo['_source']['likes'];
        $dislikesCount += $singleVideo['_source']['dislikes'];
      }

      return [
        'likes' => $likesCount,
        'dislikes' => $dislikesCount,
      ];
    }

    public function getTopRatedChannels()
    {
      $arRate = [];
      $arChannels = $this->storageInterface->search(
        [
          'index' => 'youtube_channel',
        ]
      );

      foreach ($arChannels as $channel) {
        $arChannelSummary = $this->getChannelSummary($channel['_source']['channel_id']);
        try {
          $arRate[$channel['_source']['channel_name']] = $arChannelSummary['likes'] / $arChannelSummary['dislikes'];
        } catch (Exception $e) {
          $arRate[$channel['_source']['channel_name']] = PHP_MAX_INT;
        }
      }

      asort($arRate, SORT_NUMERIC);
      return $arRate;
    }
}
