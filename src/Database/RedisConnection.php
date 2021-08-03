<?php

namespace App\Database;

use \Redis;

class RedisConnection
{
    public static function create(array $config)
    {
        $redis = new Redis();
        $redis->pconnect($config['host'], $config['port']);
        $redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_JSON);
        return $redis;
    }
}