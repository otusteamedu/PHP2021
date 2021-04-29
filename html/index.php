<?php
echo '<p>Hello world!</p>';

$m = new Memcached();
$m->addServer('memcached',11211);
$statuses = $m->getStats();
if($statuses['memcached:11211']['uptime']<1){
    echo '<p>Memcached is down!</p>';
}else{
    echo '<p>Memcached is alive!</p>';
}

$redis = new Redis();
if($redis->connect('redis', 6379)) {
    echo '<p>Redis is alive!</p>';
}
else {
    echo '<p>Redis is down!</p>';
}
