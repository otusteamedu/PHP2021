<?php

namespace App\Add;

use App\Redis\ConnectRedis;

class AddEvent 
{
    private $priority;
    private $conditions;
    private $event;
    private $countConditions;
    private $condition;
    private $param;
    private $criterion;
    private $redisKey;
    private $redis;
    private $dbSize;
    private $keys;
    private $newKey;

    public function __construct()
    {
        $this->priority = $_POST['priority'];
        $this->conditions = $_POST['conditions'];
        $this->event = $_POST['event'];

        $this->GettingСondition();
        
        $this->redis = (new ConnectRedis())->Connect();
        $this->keys = $this->redis->keys('event_*');

        $this->CreatingKeys();
        $this->newKey = "event_" . $this->newKey;
        
        $this->criterion = [
            'priority' => $this->priority,
            'conditions' => $this->condition,
            'event' => $this->event
        ];

        $this->Add();

    }

    private function GettingСondition()
    {
        
        $this->conditions = explode(',', $this->conditions);
        $this->countConditions = count($this->conditions);

        for ($i=0; $i < $this->countConditions; $i++) {

            $this->param = $this->conditions[$i];
            $this->param = explode(':', $this->param);
            $this->condition[trim($this->param[0])] = trim($this->param[1]); 

        }
    }

    private function CreatingKeys()
    {
        if ($this->keys) {

            foreach ($this->keys as $key) {
                $numberKey = explode('_', $key);
                $numberKey = $numberKey[1];
                $this->allNumberKey[] = $numberKey;
            }

            $this->newKey = max($this->allNumberKey);
            $this->newKey++;

        } else {
            $this->newKey = '0';
        }

    }

    private function Add()
    {
        
        $this->criterion = json_encode($this->criterion, JSON_UNESCAPED_UNICODE);

        $this->redis->set($this->newKey, $this->criterion);
    }



}