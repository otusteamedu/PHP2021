<?php

namespace App\Get;

use App\Redis\ConnectRedis;
use App\Get\GetCacheEvent;
use App\Add\AddCacheEvent;

class GetEvent
{
    private string $conditions;
    private array $arrayСonditions;
    private object $redis;
    private array $allEvent;
    private $suitableEvent;
    
    public function __construct()
    {   
        
        $this->conditions = $_POST['conditions'];

    }

    public function GetEvent(): string
    {
        $this->suitableEvent = (new GetCacheEvent($this->conditions))->GetCacheEvent();

        if (!$this->suitableEvent) {
            $this->redis = (new ConnectRedis())->Connect();
            $this->arrayСonditions = explode(',', $this->conditions);

            foreach ($this->arrayСonditions as $condition) {
                $condition = trim($condition);
                $keys = $this->redis->keys('*' . $condition);
                
                foreach ($keys as $key) {
                    $events = $this->redis->zRange($key, 0, -1);
                    $score = $this->redis->zScore($key, $events[0]);

                    if ($this->conditions == $events[1]) {
                        $this->allEvent[$score] = $events[0];
                    }

                }

                $maxScore = array_keys($this->allEvent);
                $maxScore = [max($maxScore)];
                $this->suitableEvent = array_intersect_key($this->allEvent, array_flip($maxScore));
                $this->suitableEvent = $this->suitableEvent[$maxScore[0]];
                
                
                $cache = (new AddCacheEvent($this->conditions, $this->suitableEvent))->AddCacheEvent();
            }
        
        }
        
        return $this->suitableEvent;
        
    }

}