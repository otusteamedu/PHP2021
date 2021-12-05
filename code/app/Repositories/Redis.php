<?php

namespace App\Repositories;

use Predis\Client;

class Redis
{
    private $client;

    public function __construct()
    {
        $this->client = new Client('tcp://redis:6379');
    }

    public function addEvent($priority, array $conditions, $event)
    {
        $id = uniqid();
        $this->client->multi();
        $this->client->zadd('events', [$id => $priority]);
        for ($i = 1; $i <= count($conditions); $i++) {
            $this->client->hset('events:' . $id, 'conditions param' . $i, $conditions[$i - 1]);
        }
        $this->client->hset('events:' . $id, 'event', $event);
        $this->client->exec();
    }
}