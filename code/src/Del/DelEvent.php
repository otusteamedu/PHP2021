<?php

namespace App\Del;

use App\Redis\ConnectRedis;

class DelEvent
{
    private $redis;

    public function __construct()
    {
        $this->redis = (new ConnectRedis())->Connect();
        
        $this->redis->flushDb();
    }

}