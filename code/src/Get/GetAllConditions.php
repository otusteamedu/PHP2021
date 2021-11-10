<?php

namespace GetAllConditions;

use ConnectRedis\ConnectRedis;
use AddCacheAllConditions\AddCacheAllConditions;
use GetCacheAllConditions\GetCacheAllConditions;

class GetAllConditions
{
    private $suitableAllСondition;
    private $redis;
    private $allKeys;
    private $conditions;

    public function __construct()
    {  

        $this->suitableAllСondition = (new GetCacheAllConditions())->GetCacheAllConditions();

        if (!$this->suitableAllСondition) {
            $this->redis = (new ConnectRedis())->Connect();
            $this->allKeys = $this->redis->keys('event_*');

            foreach ($this->allKeys as $key) 
            { 
                $get = $this->redis->get($key);
                $obj = json_decode($get);
                $this->conditions[] = $obj->conditions;
            }

            $condition = (array) $this->conditions[0];
            $this->suitableAllСondition = array_keys($condition);
            
            for ($i=1; $i < count($this->conditions); $i++) { 
                $keys = (array) $this->conditions[$i];
                $keys = array_keys($keys);
                $result = array_diff_assoc($keys, $this->suitableAllСondition);

                if ($result) {
                    $keys = array_keys($result);
                    foreach ($keys as $key) {
                        $newCondition = $result[$key];
                        $this->suitableAllСondition[] = $newCondition;
                    }  
                }
            }

            new AddCacheAllConditions($this->suitableAllСondition);

        }

        foreach ($this->suitableAllСondition as $condition) {
            echo $condition . "\n";
        }

    }
}