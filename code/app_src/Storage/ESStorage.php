<?php

namespace App\Storage;

use Elasticsearch\ClientBuilder;
use App\Interface\StorageInterface;

class ESStorage implements StorageInterface
{
  private $mainFields = ['index', 'id'];
  private $client;
  private $hosts = [
    'elastic_search',
  ];

  public function __construct()
  {
    $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
  }

  public function insert($request)
  {
    return $this->client->index($this->getRequestBody($request));
  }

  public function delete($request)
  {
    return $this->client->delete($this->getRequestBody($request));
  }

  public function search($arData)
  {
    return $this->client->search($arData)['hits']['hits'];
  }

  private function getRequestBody($request)
  {
    switch ($request['index']) {
      case 'youtube_channel':
        return $this->makeChannelArray($request);

      case 'youtube_video':
        return $this->makeVideoArray($request);

      default:
        throw new \Exception('Wrong index passed');

    }
  }

  private function makeChannelArray($request)
  {
    return [
      'index' => $request['index'],
      'id'    => $request['id'],
      'body'  => [
        'channel_id'   => $request['id'],
        'channel_name' => $request['name']
      ]
    ];
  }

  private function makeVideoArray($request)
  {
    return [
      'index' => $request['index'],
      'id'    => $request['id'],
      'body'  => [
        'video_id'   => $request['id'],
        'title'      => $request['name'],
        'likes'      => $request['video_likes'],
        'dislikes'   => $request['video_dislikes'],
        'channel_id' => $request['video_channel_id'],
      ]
    ];
  }

  public function getMainFields()
  {
    return $this->mainFields;
  }
}
