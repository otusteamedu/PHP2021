<?php

namespace App\Factory;

class RedisFactory
{
    public static function create(array $config): \Redis
    {
        $redis = new \Redis();

        $redis->pconnect($config['host'], $config['port']);
        $redis->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_JSON);

        return $redis;
    }
}