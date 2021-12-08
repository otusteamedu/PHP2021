<?php

namespace App\Repositories;

use App\Interfaces\NoSqlRepositoryInterface;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use Predis\Client;

class MongoDB implements NoSqlRepositoryInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Manager('mongodb://' . MONGO_HOST . ':' . MONGO_PORT);
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
        $this->client->executeBulkWrite('db.events', $bulk);
    }

    public function findByCondition($conditions)
    {
        $queryConditions = [];
        foreach ($conditions as $conditionName => $conditionValue) {
            $queryConditions[]["conditions." . $conditionName] = $conditionValue;
        }
        unset($conditions);
        $filter = [
            '$or' => 
                $queryConditions

        ];
        $query = new Query($filter,[
            'sort' => ['priority' => -1],
            'limit' => 1
        ]);
        $documents = $this->client->executeQuery('db.events',$query)->toArray();
        return $documents[0]->event;
    }

    public function deleteAllEvents()
    {
        $bulk = new BulkWrite();
        $bulk->delete([]);
        $this->client->executeBulkWrite('db.events', $bulk);
    }
}