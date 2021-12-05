<?php
require '../vendor/autoload.php';

const REDIS_HOST = 'localhost';
const REDIS_PORT = 6379;

$repository = new \App\Repositories\Redis();
//$repository = new \App\Repositories\MongoDB();
$repository->addEvent(1000, [
    'param1' => 1
], 'event1');
$repository->addEvent(2000, [2, 2], 'event2');
$repository->addEvent(3000, [1, 2], 'event3');
$repository->findByCondition(['param1' => 1,'param2' => 2]);