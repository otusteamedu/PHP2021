<?php

namespace App\Repositories;

use Predis\Client;

class Redis
{
    private $client;

    public function __construct()
    {
        $this->client = new \Redis();
        $this->client->connect('localhost', '6379');
    }

    public function addEvent($priority, array $conditions, $event)
    {
        $id = uniqid();
        $this->client->multi();
        $this->client->zAdd('events', [], $priority, $id);
        for ($i = 1; $i <= count($conditions); $i++) {
            $this
                ->client
                ->hSet('event_conditions', $id . ' param' . $i, $conditions[$i - 1]);
        }
        $this->client->set('event_names:' . $id, $event);
        $this->client->exec();
    }

    public function findByCondition($conditions)
    {
        $events = $this->parseHashTable($this->client->hGetAll('event_conditions'));
        $events = array_filter($events, function ($event) use ($conditions){
            foreach ($conditions as $conditionName => $conditionValue) {
                if (!empty($event[$conditionName]) && $event[$conditionName] == $conditionValue) return true;
            }
        });
        $priority = [];
        foreach ($events as $eventId => $eventContaining) {
            $eventRating = $this->client->zScore('events', $eventId);
            $priority[$eventRating] = $eventId;
        }
        sort($priority);
        $mostPriority = last($priority);
        var_dump($this->client->get($mostPriority));
        print_r($this->client->zscore('events', '61acefe369360'));
        print_r($this->client->get('event_names:61acefe369360'));
        exit();
    }

    private function parseHashTable($hashTable)
    {
        $parsedTabble = [];
        foreach ($hashTable as $hashRow => $hashValue) {
            $hashRow = explode(' ', $hashRow);
            $parsedTabble[$hashRow[0]][$hashRow[1]] = $hashValue;
        }
        return $parsedTabble;
    }
}