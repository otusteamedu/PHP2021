<?php
require '../vendor/autoload.php';

$repository = new \App\Repositories\Redis();
echo $repository->index();