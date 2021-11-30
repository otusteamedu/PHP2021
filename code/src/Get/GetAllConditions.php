<?php

namespace App\Get;

use App\Redis\ConnectRedis;
use App\Add\AddCacheAllConditions;
use App\Get\GetCacheAllConditions;

class GetAllConditions
{

    private $suitableAllСondition;
    private object $redis;
    private array $allKeys;
    private array $allСondition;

    public function GetAllConditions(): array
    {
        $this->suitableAllСondition = (new GetCacheAllConditions())->GetCacheAllConditions();

        if (!$this->suitableAllСondition) {
            $this->redis = (new ConnectRedis())->Connect();
            $this->allKeys = $this->redis->keys('*');

            foreach ($this->allKeys as $key){
                $events = $this->redis->zRange($key, 0, -1);
                $events = str_replace(" ", "", $events);
                $this->allСondition[] = $events[0];
            }

            (new AddCacheAllConditions($this->allСondition))->AddCacheAllConditions();
        } else {
            $this->allСondition = $this->suitableAllСondition;
        }

        return $this->allСondition ;
    }
}