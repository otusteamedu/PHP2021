<?php
echo "Hello, world! ";

#redis
$redis = new Redis();
$redis->connect(
    $_ENV['REDIS_HOST']
);
$redis->auth($_ENV['REDIS_PASSWORD']);
if ( ! $redis->exists('testkey')) {
    $redis->set('testkey', 'value from redis');
}
echo '<pre>' . $redis->get('testkey') . '</pre>';
$redis->close();

#memcached
$memcached = new Memcached();
$memcached->addServer(
    $_ENV['MEMCACHED_HOST'],
    $_ENV['MEMCACHED_port']);
$memcached->set('testkey', 'value from memcached');
echo '<pre>' . $memcached->get('testkey') . '</pre>';

phpinfo();