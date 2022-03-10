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

  public function insert($request)
  {
    return $this->client->index($this->makeIndexArray($request));
  }

  public function deleteAll()
  {
    $arDocuments = $this->search([
      'index' => 'events'
    ]);

    foreach ($arDocuments as $document) {
      $this->client->delete([
        'index' => 'events',
        'id'    => $document['_id'],
      ]);
    }
  }

  public function searchEvent($arData)
  {
    $arEvents = $this->getSuitableEvents($arData['user_params']);
    $arEventPriority = $this->getEventPriorityArray($arEvents);
    asort($arEventPriority);

    return array_key_last($arEventPriority);
  }

  private function getSuitableEvents($filter)
  {
    $params = [
      'index' => 'events',
      'body'  => [
        'query' => [
          'bool' => [
            'should' => [
              'match_all' => new \stdClass()
            ],
            'filter' => [
              'terms' => [
                'conditions' => array_map('trim', explode(',', $filter))
              ]
            ]
          ]
        ]
      ]
    ];

    return $this->client->search($params)['hits']['hits'];
  }

  private function getEventPriorityArray($arEvents)
  {
    $arEventPriority = [];

    foreach ($arEvents as $event) {
      $arEventPriority[$event['_source']['name']] = $event['_source']['priority'];
    }

    return $arEventPriority;
  }

  private function makeIndexArray($request)
  {
    return [
      'index' => 'events',
      'body'  => [
        'priority' => $request['priority'],
        'name'    => $request['event'],
        'conditions' => array_map('trim', explode(',', $request['conditions'])),
      ]
    ];
  }
}
