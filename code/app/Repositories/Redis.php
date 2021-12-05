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

    public function addEvent()
    {
        $this->client->multi();
        $id = uniqid();
        $this->client->zadd('events', [$id => 1000]);
        $this->client->hset('events:' . $id, 'conditions param1', 1);
        $this->client->hset('events:' . $id, 'conditions param2', 2);
        $this->client->exec();
    }
}