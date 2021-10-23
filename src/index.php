<?php

const TEST_KEY = 'test';

$host = getenv('LOCAL_HOST');
$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s',
    $host,
    getenv('MYSQL_PORT'),
    getenv('MYSQL_DATABASE')
);

try {
    $pdo = new Pdo($dsn, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    $redis = new Redis();
    $redis->connect($host, getenv('REDIS_PORT'));

    if (!$redis->exists(TEST_KEY)) {
        $redis->set(TEST_KEY, 'Hello', ['ex' => 3600]);
    }

    $memcached = new Memcached();
    $memcached->addServer($host, getenv('MEMCACHED_PORT'));

    if ($memcached->get(TEST_KEY) === false) {
        $memcached->set(TEST_KEY, 'Otus', 3600);
    }

    echo sprintf('%s, %s!', $redis->get(TEST_KEY), $memcached->get(TEST_KEY));
} catch (Throwable $e) {
    echo $e->getMessage();
}

phpinfo();
