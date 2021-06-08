<?php

include 'vendor/autoload.php';

try {
    $client = new App\App(__DIR__ . '/configs/socket.yml');
    $client->run($argv[1] ?? '');
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}
