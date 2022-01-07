<?php

# проверка работы статики
echo "<div> <img src='test.jpg' alt='test'> </div>";

$redis = new Redis();
echo 'redis start: ' . $redis->connect('redis') . "<br>";

$mc = new Memcached();
$mc->addServer("memcached", 11211);
echo 'memcached start: ' . $mc->addServer("memcached", 11211);
