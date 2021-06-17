<?php

include __DIR__ . '/../vendor/autoload.php';

$container = include __DIR__ . '/dependencies.php';
$router = include __DIR__ . '/router.php';

return new App\Server([
    new Middlewares\Emitter(),
    new Middlewares\FastRoute($router),
    new Middlewares\JsonPayload(),
    new Middlewares\RequestHandler($container)
]);
