<?php
require '../vendor/autoload.php';

const REDIS_HOST = 'localhost';
const REDIS_PORT = 6379;

//$repository = new \App\Repositories\Redis();
$repository = new \App\Repositories\MongoDB();
$repository->addEvent(1000, [
    'param1' => 1
], 'event1');
$repository->addEvent(2000, [
    'param1' => 2,
    'param2' => 2
], 'event2');
$repository->addEvent(3000, [
    'param1' => 1,
    'param2' => 2
], 'event3');
echo $repository->findByCondition(['param1' => 2,'param2' => 2]);
//$repository->deleteAllEvents();