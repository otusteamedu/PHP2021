<?php

namespace App\Repositories;

use App\Interfaces\NoSqlRepositoryInterface;

class Redis implements NoSqlRepositoryInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new \Redis();
        $this->client->connect(config('nosql.host'), config('nosql.port'));
    }

    public function addEvent(string $event, array $conditions, int $priority):void
    {
        $id = uniqid();
        $this->client->multi();
        $this->client->zAdd('events', [], $priority, $id);
        foreach ($conditions as $conditionName => $conditionValue) {
            $this
                ->client
                ->hSet('event_conditions', $id . ' ' . $conditionName, $conditionValue);
        }
        $this->client->set('event_names:' . $id, $event);
        $this->client->exec();
    }

    public function findByCondition(array $conditions):string
    {
        if (!$conditions) return '';
        $events = $this->parseHashTable($this->client->hGetAll('event_conditions'));
        $events = array_filter($events, function ($event) use ($conditions){
            foreach ($conditions as $conditionName => $conditionValue) {
                if (!empty($event[$conditionName]) && $event[$conditionName] == $conditionValue) return true;
            }
        });
        $priorityEvents = [];
        foreach ($events as $eventId => $eventContaining) {
            $eventRating = $this->client->zScore('events', $eventId);
            $priorityEvents[$eventRating] = $eventId;
        }
        sort($priorityEvents);
        $mostPriorityEvent = array_pop($priorityEvents);
        return $this->client->get('event_names:' . $mostPriorityEvent);
    }

    public function deleteAllEvents():void
    {
        $eventIds = $this->client->zRange('events', 0, -1);
        foreach ($eventIds as $eventId) {
            $this->client->del('event_names:'.$eventId);
        }
        $this->client->del('event_conditions');
        $this->client->del('events');
    }

    private function parseHashTable($hashTable):array
    {
        $parsedTable = [];
        foreach ($hashTable as $hashRow => $hashValue) {
            $hashRow = explode(' ', $hashRow);
            $parsedTable[$hashRow[0]][$hashRow[1]] = $hashValue;
        }
        return $parsedTable;
    }
}
