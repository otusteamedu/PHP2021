<?php

namespace App\Storage;


use App\Interfaces\StorageInterface;
use Predis\Client;

class RedisStorage implements StorageInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host' => '172.24.0.3', // IP контейнера с Redis
            'port' => 6379,
        ]);
    }

    public function insert(array $arData): array
    {
        $eventId = uniqid();
        $result['data'] = $this->client->rpush("conditions:{$arData['conditions']}", $eventId);

        $this->client->set("event:$eventId:priority", $arData['priority']);
        $this->client->set("event:$eventId:name", $arData['event']);

        if ($result['data']) {
            $result['action'] = 'add';
        } else {
            throw new \Exception('Ошибка добавления данных в хранилище Redis');
        }

        return $result;
    }

    public function deleteAll(): array
    {
        $this->client->del($this->client->keys('*'));

        $result['action'] = 'delete';

        return $result;
    }

    public function searchEvent(array $arData): array
    {
        $eventIds = $this->getSuitableEventIds($arData['conditions']);
        $arEvents = $this->getEventPriorityArray($eventIds);
        $result['most_priority_event'] = array_key_last($arEvents);

        if ($result['most_priority_event']) {
            $result['priority'] = $arEvents[$result['most_priority_event']];
            $result['action'] = 'search';

        } else {
            $result['action'] = 'empty';
        }

        return $result;
    }

    private function getSuitableEventIds($conditionKey): array
    {
        $conditionKeys = $this->getConditionKeys($conditionKey);
        $eventIds = [];

        if ($conditionKeys) {
            $eventIds = $this->client->lrange($conditionKeys[0], 0, -1);
        }

        return $eventIds;
    }

    private function getEventPriorityArray($arIds): array
    {
        $arEventPriority = [];

        foreach ($arIds as $id) {
            $arEventPriority[$this->client->get("event:$id:name")] = $this->client->get("event:$id:priority");
        }

        asort($arEventPriority);

        return $arEventPriority;
    }

    private function getConditionKeys($fullKey)
    {
        $conditionKeys = $this->client->keys("conditions:$fullKey");

        return $conditionKeys;
    }
}
