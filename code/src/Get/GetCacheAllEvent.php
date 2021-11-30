<?php

namespace App\Get;

use App\Redis\ConnectCacheRedis;

class GetCacheAllEvent
{
    private object $redisCache;
    private array $allKeys;
    private $allEvent;

    public function GetCacheAllEvent()
    {  
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->allKeys = $this->redisCache->keys('all_event_cache');

        if ($this->allKeys) {
            $this->allEvent = $this->redisCache->get($this->allKeys[0]);
            $this->allEvent = json_decode($this->allEvent);
            return $this->allEvent;
        } 
        
    }
}