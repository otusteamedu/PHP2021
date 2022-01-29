<?php
require __DIR__ . '/../vendor/autoload.php';

try {
    $container = require __DIR__ . '/../app/bootstrap.php';
    $route = $container->get('App\Route');
    $route->route($container);
} catch (Exception $e) {
    echo $e->getMessage();
}