<?php

namespace App\Get;

use App\Redis\ConnectRedis;
use App\Get\GetCacheEvent;
use App\Add\AddCacheEvent;

class GetEvent
{
    private $conditions;
    private $parameters;
    private $suitableEvent;
    private $redis;
    private $allKeys;
    private $allEvent;

    public function __construct()
    {   

        $this->conditions = $_POST['conditions'];
        $this->conditions = explode(',', $this->conditions);

        $this->GettingParameters();

        $this->suitableEvent = (new GetCacheEvent())->GetCacheEvent($this->parameters);
        
        $this->SearchSuitableEvent();

        $this->Output();
        
    }

    private function GettingParameters()
    {
        foreach ($this->conditions as $searchParameters) {
            $searchParameters = explode(':', $searchParameters);
            $this->parameters[trim($searchParameters[0])] = trim($searchParameters[1]);
        }
    }

    private function SearchSuitableEvent()
    {
        if (!$this->suitableEvent) {

            $this->redis = (new ConnectRedis())->Connect();
            $this->allKeys = $this->redis->keys('event_*');

            foreach ($this->allKeys as $key) 
            {
                $get = $this->redis->get($key);
                $obj = json_decode($get);
                $arrConditions = (array) $obj->conditions;

                $countParameters = count($this->parameters);
                $countArrConditions = count($arrConditions);

                if ($countParameters == $countArrConditions) {
                    $result = array_diff_assoc($arrConditions, $this->parameters);

                    if (!$result) {
                        $event = [
                            'event' => $obj->event
                        ];
                        $priority = $obj->priority;
                        $this->allEvent[$priority] = $event;
                        
                    }
                }

                if (isset($this->allEvent)) {
                    $keys = array_keys($this->allEvent);
                    $keys = [max($keys)];
                    $this->suitableEvent = array_intersect_key($this->allEvent, array_flip($keys));
                    $this->suitableEvent = $this->suitableEvent[$keys[0]]['event'];
                }
            }

            
            new AddCacheEvent($this->parameters, $this->suitableEvent);

        }
    }

    private function Output()
    {
        echo $this->suitableEvent;
    }
}