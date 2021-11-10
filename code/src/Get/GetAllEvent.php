<?php

namespace GetAllEvent;

use ConnectRedis\ConnectRedis;
use GetCacheAllEvent\GetCacheAllEvent;
use AddCacheAllEvent\AddCacheAllEvent;

class GetAllEvent
{
    private $suitableAllEvent;
    private $redis;
    private $allKeys;

    public function __construct()
    {  

        $this->suitableAllEvent = (new GetCacheAllEvent())->GetCacheAllEvent();

        if (!$this->suitableAllEvent) {

            $this->redis = (new ConnectRedis())->Connect();

            $this->allKeys = $this->redis->keys('event_*');

            foreach ($this->allKeys as $key) 
            { 
                $get = $this->redis->get($key);
                $obj = json_decode($get);
                $this->suitableAllEvent[] = $obj->event;
            }

            new AddCacheAllEvent($this->suitableAllEvent);
        }

        foreach ($this->suitableAllEvent as $event) {
            echo $event . "\n";
        }
    
    }

}