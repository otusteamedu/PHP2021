<?php

namespace App\Redis;

use Redis;

class ConnectCacheRedis
{

    public function Connect()
    {
        $redis = new Redis();
        $redis->connect('redis', 6379);
        $redis->select(1);

        return $redis;
    }
}