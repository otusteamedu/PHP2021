<?php
header( 'Content-Type: text/html; charset=utf-8' );

$memcached_host = getenv('MEMCACHED_SERVER', true) ?: getenv('MEMCACHED_SERVER');
$memcached_port = getenv('MEMCACHED_PORT', true) ?: getenv('MEMCACHED_PORT');

$m = new Memcached();
$m->addServer($memcached_host, $memcached_port);

$key = 'otustest_1';

$value = $m->get($key);

if( $value )
{
    echo 'got value from memcached: ' . $value;
}
else
{
    $value = 'test at ' . date('Y-m-d H:i:s');
    $vl = $m->set($key, $value,60*60);
    echo 'set value and got it from memcached: ' . $m->get($key);
}
