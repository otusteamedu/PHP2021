<?php
header( 'Content-Type: text/html; charset=utf-8' );

require_once './includes/redis.php';

$redis_host = getenv('REDIS_SERVER', true) ?: getenv('REDIS_SERVER');
$redis_port = getenv('REDIS_PORT', true) ?: getenv('REDIS_PORT');

$redis = new redis_cli($redis_host, $redis_port);

if ( is_null($redis) )
{
    die('could not connect to redis server');
}

$key = 'otustest_1';
$value = 'test at ' . date('Y-m-d H:i:s');

if ( $redis->cmd('EXISTS', $key)->get() )
{
    $from_redis = $redis->cmd('GET', $key)->get();
    echo 'got value from redis: ' . $from_redis;
}
else
{
    if ( $redis->cmd('SET', $key, $value )->set() )
    {
        echo 'value was saved to redis, reload to see result';
    }
    else
    {
        echo 'could not set value to redis';
    }
}


