<?php

//phpinfo();

$redis = new Redis();
$redis->connect('redis', 6379);
echo "Connection to redis server sucessfully <br>";

$mc = new Memcached();
$mc->addServer("memcached", 11211);
echo "Connection to memcached server sucessfully";