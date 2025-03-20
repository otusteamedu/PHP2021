<?php

namespace App\Domain;

use App\Application\Interfaces\StorageInterface;
use Predis\Client as RedisClient;

class RedisStorage implements StorageInterface
{
    private RedisClient $client;

    public function __construct()
    {
        $this->client = new RedisClient(['scheme' => 'tcp', 'host' => '172.28.0.3', 'port' => 6379]);
    }

    public function insert(string $eventId): string
    {
        $this->client->set("event:$eventId:status", 'running');

        return $eventId;
    }

    public function update(string $eventId, string $status): void
    {
        $this->client->set("event:$eventId:status", $status);
    }

    public function searchById(string $eventId): ?string
    {

        return $this->client->get("event:$eventId:status");
    }

    public function getAllStatements(): array
    {
        $allStatements = $this->client->keys('*');
        $arIds = [];

        foreach ($allStatements as $statement) {
            $arIds[] = explode(':', $statement)[1];
        }
        return $arIds;
    }
}
