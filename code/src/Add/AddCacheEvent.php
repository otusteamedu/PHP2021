<?php

namespace App\Add;

use App\Redis\ConnectCacheRedis;

class AddCacheEvent 
{
    private object $redisCache;
    private string $conditions;
    private string $suitableEvent;
    private array $arrayСonditions;
    private string $key;

    public function __construct(string $conditions, string $suitableEvent)
    {
        $this->conditions = $conditions;
        $this->suitableEvent = $suitableEvent;
    }

    public function AddCacheEvent()
    {
        $this->conditions = str_replace(" ", "", $this->conditions);
        $this->key = str_replace(",", ":", $this->conditions);
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->redisCache->set($this->key, $this->suitableEvent, 600);
    }
}