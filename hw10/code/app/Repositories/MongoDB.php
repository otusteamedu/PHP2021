<?php

namespace App\Repositories;

use MongoDB\BSON\ObjectId;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use Predis\Client;

class MongoDB
{
    private $client;

    public function __construct()
    {
//        $this->client = new \MongoDB\Client('mongodb://localhost:27017');
        $this->client = new Manager('mongodb://localhost:27017');
    }

    public function addEvent($priority, array $conditions, $event)
    {
        $bulk = new BulkWrite();
        $event = [
            '_id' => new ObjectId(),
            'event' => $event,
            'priority' => $priority,
            'conditions' => $conditions
        ];
        $bulk->insert($event);
//        var_dump($this->client->executeBulkWrite('db.collection', $bulk));
//        exit();
    }

    public function findByCondition($conditions)
    {
        $client = new \MongoDB\Client();
        var_dump($client);
    }
}