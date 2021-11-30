<?php

namespace App\Add;

use App\Redis\ConnectRedis;

class AddEvent
{
    private int $priority;
    private string $event;
    private string $conditions;
    private array $arrayСonditions;
    private object $redis;

    public function __construct()
    {
        $this->priority = $_POST['priority'];
        $this->event = $_POST['event'];
        $this->conditions = $_POST['conditions'];

    }

    public function AddEvent()
    {
        $this->redis = (new ConnectRedis())->Connect();
        $this->arrayСonditions = explode(',', $this->conditions);

        foreach ($this->arrayСonditions as $condition) {
            $key = trim($this->event) . ':' . trim($condition);
            $this->redis->zAdd($key, $this->priority, trim($this->event));
            $this->redis->zAdd($key, $this->priority, $this->conditions);
        }

    }

}
