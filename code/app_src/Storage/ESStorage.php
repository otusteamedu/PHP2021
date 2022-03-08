<?php

namespace App\Storage;

use Elasticsearch\ClientBuilder;
use App\Interface\StorageInterface;

class ESStorage implements StorageInterface
{

  private $client;
  private $hosts = [
    'elastic_search',
  ];

  public function __construct()
  {
    $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
  }

  public function insert($arData)
  {
    $params = [
      'index' => $arData['index'],
      'body'  => $arData['body']
    ];

    return $this->client->index($params);
  }

  public function delete($arData)
  {
    $params = [
      'index' => $arData['index'],
      'id'    => $arData['id']
    ];

    return $this->client->delete($params);
  }

  public function search($arData)
  {
    return $this->client->search($arData)['hits']['hits'];
  }
}
