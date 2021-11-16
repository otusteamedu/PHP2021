<?php

namespace App\Get;

use App\Redis\ConnectRedis;
use App\Get\GetCacheAllEvent;
use App\Add\AddCacheAllEvent;

class GetAllEvent
{
    private $suitableAllEvent;
    private $redis;
    private $allKeys;

    public function __construct()
    {  

        $this->suitableAllEvent = (new GetCacheAllEvent())->GetCacheAllEvent();

        $this->Search();

        $this->Output();
    
    }

    private function Search()
    {
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
    }

    private function Output()
    {
        foreach ($this->suitableAllEvent as $event) {
            echo $event . "\n";
        }
    }

}