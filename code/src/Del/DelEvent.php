<?php

namespace DelEvent;

use ConnectRedis\ConnectRedis;

class DelEvent
{
    private $redis;

    public function __construct()
    {
        $this->redis = (new ConnectRedis())->Connect();
        
        $this->redis->flushDb();
    }

}