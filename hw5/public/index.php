<?php

include __DIR__ . '/../vendor/autoload.php';

try {
    $container = include __DIR__ . '/../dependencies/dependencies.php';

    $server = $container->get(App\Http\Server::class);
    $server->run();
} catch (Throwable $e) {
    echo $e->getMessage();
    http_response_code(500);
}
