<?php

try {
    $pdo = new PDO(
        'mysql:host=db_service;dbname=service;charset=utf8',
        'service_user',
        'service_pass'
    );
    $pdo->query('SELECT 1');
    echo 'Database connection established <br/>';

    $memcached = new Memcached();
    $memcached->addServer('memcached_service', 11211);
    $memcached->set('key', 'val');
    echo 'Memcached connection established <br/>';

    $redis = new Redis();
    $redis->connect('redis_service', 6379);
    $redis->ping();

    echo 'Redis connection established <br/>';
} catch (Throwable $e) {
    echo $e->getMessage();
}
