<?php

namespace App\Get;

use App\Redis\ConnectCacheRedis;

class GetCacheAllEvent
{
    private $redisCache;
    private $allKeys;

    public function GetCacheAllEvent()
    {  
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->allKeys = $this->redisCache->keys('all_event_cache');

        if ($this->allKeys) {
            $get = $this->redisCache->get($this->allKeys[0]);
            $obj = json_decode($get);
            return $obj;
        }
    }
}