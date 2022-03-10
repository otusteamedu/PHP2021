<?php

namespace App\Storage;

use App\Interface\StorageInterface;

class RedisStorage implements StorageInterface
{
  private $client;

  public function __construct()
  {
    $this->client = new \Predis\Client([
      'scheme' => 'tcp',
      'host'   => '172.17.0.1',
      'port'   => 6379,
    ]);
  }

  public function insert($arData)
  {
    $eventId = uniqid();

    $this->client->rpush("conditions:{$arData['conditions']}", $eventId);
    $this->client->set("event:$eventId:priority", $arData['priority']);
    $this->client->set("event:$eventId:name", $arData['event']);

    return $eventId;
  }

  public function deleteAll()
  {
    $this->client->del($this->client->keys('*'));
  }

  public function searchEvent($arData)
  {
    $eventIds = $this->getSuitableEventIds($arData['user_params']);
    $arEventPriority = $this->getEventPriorityArray($eventIds);
    asort($arEventPriority);
    
    return array_key_last($arEventPriority);
  }

  private function getSuitableEventIds($conditionKey)
  {
    $eventIds = [];
    $conditionKeys = $this->getConditionKeys($conditionKey);


    foreach ($conditionKeys as $key) {
      $eventIds = array_merge($eventIds, $this->client->lrange($key, 0, -1));
    }

    return $eventIds;
  }

  private function getEventPriorityArray($arIds)
  {
    $arEventPriority = [];

    foreach ($arIds as $id) {
      $arEventPriority[$this->client->get("event:$id:name")] = $this->client->get("event:$id:priority");
    }

    return $arEventPriority;
  }

  private function getConditionKeys($fullKey)
  {
      $conditionKeys = [];
      $conditionKeys = array_merge($conditionKeys, $this->client->keys("conditions:$fullKey"));

      foreach (explode(',', $fullKey) as $keyPart) {
          $conditionKeys = array_merge($conditionKeys, $this->client->keys('conditions:'.trim($keyPart)));
      }

      return $conditionKeys;
  }
}
