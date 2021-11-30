<?php

namespace App\Get;

use App\Redis\ConnectRedis;
use App\Get\GetCacheAllEvent;
use App\Add\AddCacheAllEvent;

class GetAllEvent
{
    private $suitableAllEvent;
    private object $redis;
    private array $allKeys;
    private array $allEvents;

    public function GetAllEvent(): array
    {
        $this->suitableAllEvent = (new GetCacheAllEvent())->GetCacheAllEvent();

        if (!$this->suitableAllEvent) {
            $this->redis = (new ConnectRedis())->Connect();
            $this->allKeys = $this->redis->keys('*');

            foreach ($this->allKeys as $key){
                $events = $this->redis->zRange($key, 0, -1);
                $events = str_replace(" ", "", $events);
                $this->allEvents[] = $events[1];
            }

            (new AddCacheAllEvent($this->allEvents))->AddCacheAllEvent();
        } else {
            $this->allEvents = $this->suitableAllEvent;
        }

        return $this->allEvents ;
    }

}