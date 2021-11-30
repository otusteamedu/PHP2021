<?php

namespace App\Get;

use App\Redis\ConnectCacheRedis;

class GetCacheEvent
{
    private object $redisCache;
    private string $conditions;
    private array $keys;
    private $suitableEvent;

    public function __construct(string $conditions)
    {
        $this->conditions = $conditions;
    }

    public function GetCacheEvent()
    {
        $this->conditions = str_replace(" ", "", $this->conditions);
        $this->key = str_replace(",", ":", $this->conditions);
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $keys = $this->redisCache->keys($this->key);

        if ($keys) {
            $this->suitableEvent = $this->redisCache->get($keys[0]);
        }
        
        return $this->suitableEvent;
    }
    
}