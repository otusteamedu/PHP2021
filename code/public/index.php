<?php
require '../vendor/autoload.php';

$repository = new \App\Repositories\Redis();
//$repository->addEvent(1000, [1], 'event1');
//$repository->addEvent(2000, [2, 2], 'event2');
//$repository->addEvent(3000, [1, 2], 'event3');
$repository->findByCondition(['param1' => 1,'param2' => 2]);