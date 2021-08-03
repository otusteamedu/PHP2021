<?php


use App\App\Server;

require __DIR__ . '/../vendor/autoload.php';

try {
    $container = require __DIR__ . '/../bootstrap/index.php';
    $server = new Server($container);
    $server->run();
} catch (Exception $e) {
    echo $e->getMessage();
}