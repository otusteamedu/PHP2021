<?php

namespace App\Del;

use App\Redis\ConnectRedis;

class DelEvent
{
    private $redis;

    public function Del()
    {
        $this->redis = (new ConnectRedis())->Connect();
        
        $this->redis->flushDb();
    }

}