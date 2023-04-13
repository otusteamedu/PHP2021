<?php

namespace App\Storage;

use App\YouTubeHandler;
use Elasticsearch\ClientBuilder;
use App\MyInterface\StorageInterface;

class ESStorage
{
  private $mainFields = ['index', 'id'];
  private $client;
  private $hosts = [
    'elastic_search',
  ];
  private $youTube;

  public function __construct()
  {
    $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
    $this->youTube = new YouTubeHandler();
  }

  public function insert($request)
  {
      $arRequest = $this->getFormattingData($request['name']);

      $result[] = $this->client->index($arRequest['channelData']);
      foreach ($arRequest['videos'] as $video) {
          $result[] = $this->client->index($video);
      }
      $result['action'] = 'created';

    return $result;
  }

  public function delete($request)
  {
      $arParams = [
          'index' => $request['index'],
          'id'    => $request['id']
      ];
    return $this->client->delete($arParams);
  }

  public function search($arData)
  {
    return $this->client->search($arData)['hits']['hits'];
  }

  private function getFormattingData($channelName)
  {




      $channelData = $this->youTube->getYouTubeChannelData($channelName);

      foreach ($channelData as $elem) {

          if($elem->id->kind === 'youtube#channel') {
              $arChannel['channelData'] = $this->makeChannelArray($elem);
          } else {
              $arChannel['videos'][] = $this->makeVideoArray($elem);
          }

      }

      return $arChannel;
   /* switch ($request['index']) {
      case 'youtube_channel':
        return $this->makeChannelArray($request);

      case 'youtube_video':
        return $this->makeVideoArray($request);

      default:
        throw new \Exception('Wrong index passed');

    }*/
  }

  private function makeChannelArray($channelData)
  {
    return [
      'index' => 'youtube_channel',
      'id'    => $channelData->id->channelId,
      'body'  => [
        'channel_name' => $channelData->snippet->channelTitle
      ]
    ];
  }

  private function makeVideoArray($video)
  {
      $likes = $this->youTube->getVideoLikes($video->id->videoId);

    return [
      'index' => 'youtube_video',
      'id'    => $video->id->videoId,
      'body'  => [
        'title'      => $video->snippet->title,
        'likes'      => $likes,
        'channel_id' => $video->snippet->channelId,
      ]
    ];
  }

  public function getMainFields()
  {
    return $this->mainFields;
  }
}
