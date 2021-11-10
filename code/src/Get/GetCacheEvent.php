<?php

namespace GetCacheEvent;

use ConnectCacheRedis\ConnectCacheRedis;

class GetCacheEvent
{
    private $redisCache;
    private $suitableEvent;
    private $keys;

    public function GetCacheEvent($parameters)
    {
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->keys = $this->redisCache->keys('event_cache_*');
        
        foreach ($this->keys as $key) {
            $get = $this->redisCache->get($key);
            $obj = json_decode($get);
            
            if ($obj) {
                $eventsCache = (array) $obj->conditions;
                $result = array_diff_assoc($eventsCache, $parameters);
                
                if (!$result) {
                    $this->suitableEvent = $obj->event;
                }
                
            }
            
        }
        return $this->suitableEvent;
    }
}