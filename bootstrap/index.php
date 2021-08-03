<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');

$settings = $dotenv->load();

$redisConn = App\Database\RedisConnection::create([
   'host' => $settings['REDIS_HOST'],
   'port' => $settings['REDIS_PORT'],
]);

return [
  'redis' => $redisConn,
];