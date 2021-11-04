<?php 
$m = new Memcached();
$m->addServer('memcached', 11211);
echo '<pre>'; print_r($m->getVersion()); echo '</pre>';

$redis = new Redis();
 
$redis->connect('redis', 6379);
 
$redis->set('test_php_key', 'test php value');
echo '<br>' . $redis->get('test_php_key');

phpinfo();
