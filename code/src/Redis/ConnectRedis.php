<?php

namespace ConnectRedis;
use Redis;

class ConnectRedis
{

    public function Connect()
    {
        $redis = new Redis();
        $redis->connect('redis', 6379);
        $redis->select(0);

        return($redis);
    }
}