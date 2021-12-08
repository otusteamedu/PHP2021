<?php

namespace App\Repositories;

use MongoDB\BSON\ObjectId;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
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
    }

    public function findByCondition($conditions)
    {
        $connection = $this->client;
        $filter = ['$or' => [["conditions.param1" => 1], ["conditions.param1" => 2]]];

        $query = new Query($filter,[]);

        $documents = $connection->executeQuery('db.collection' /*dbname.collection_name*/,$query);

        foreach($documents as $document){
            $document = json_decode(json_encode($document),true);
            var_dump($document);
        }
    }
}