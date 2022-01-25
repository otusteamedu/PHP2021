<?php

use App\App;
use App\BracketsControllerInterface;
use DI\Container;

require_once('./vendor/autoload.php');

try {

    $container = new DI\Container();
    $container->set('BracketsControllerInterface', \DI\create('BracketsController'));
    $app = $container->get(App::class);
    $app->run($argv);
} catch (Exception $e) {
    echo $e->getMessage();
}