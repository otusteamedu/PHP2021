<?php
require __DIR__ . '/../vendor/autoload.php';

try {

    $container = require __DIR__ . '/../app/bootstrap.php';
    $app = $container->get('App\App');
    $app->run($container);

} catch (Exception $e) {
    echo $e->getMessage();
}