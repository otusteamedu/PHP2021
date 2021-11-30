<?php

namespace App\Redis;

use Redis;

class ConnectRedis
{
    private Redis $redis;

    public function Connect(): Redis
    {
        $this->redis = new Redis();
        $this->redis->connect('redis', 6379);
        $this->redis->select(0);

        return $this->redis;
    }
}