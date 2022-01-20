<?php
$memcached = new Memcached();
$memcached->addServer('memcached', 11211);
echo '<b>Версия Memcached:</b> ' . $memcached->getVersion()['memcached:11211'];

$redis = new Redis();
$redis->connect('redis', 6379);

$redis->set('test_redis', 'Redis работает!!!');
echo '<br><b>' . $redis->get('test_redis') . '</b>';

phpinfo();
