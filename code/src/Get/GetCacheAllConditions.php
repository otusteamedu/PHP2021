<?php

namespace App\Get;

use App\Redis\ConnectCacheRedis;

class GetCacheAllConditions
{ 
    private object $redisCache;
    private array $allKeys;
    private $allConditions;

    public function GetCacheAllConditions()
    {  
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->allKeys = $this->redisCache->keys('all_conditions_cache');

        if ($this->allKeys) {
            $this->allConditions = $this->redisCache->get($this->allKeys[0]);
            $this->allConditions = json_decode($this->allConditions);
            return $this->allConditions;
        }
    }
}