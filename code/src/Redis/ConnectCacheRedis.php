<?php

namespace App\Redis;

use Redis;

class ConnectCacheRedis
{

    private Redis $redis;

    public function Connect(): Redis
    {
        $this->redis = new Redis();
        $this->redis->connect('redis', 6379);
        $this->redis->select(1);

        return $this->redis;
    }
}