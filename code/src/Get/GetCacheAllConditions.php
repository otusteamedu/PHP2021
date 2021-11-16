<?php

namespace App\Get;

use App\Redis\ConnectCacheRedis;

class GetCacheAllConditions
{ 
    private $redisCache;
    private $allKeys;

    public function GetCacheAllConditions()
    {  
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->allKeys = $this->redisCache->keys('all_conditions_cache');

        if ($this->allKeys) {
            $get = $this->redisCache->get($this->allKeys[0]);
            $obj = json_decode($get);
            return $obj;
        }
    }
}