<?php

include __DIR__ . '/../vendor/autoload.php';

use MySite\App;

$container = include __DIR__ . '/../src/MySite/bootstrap/container.php';

$router = include __DIR__ . '/../src/MySite/bootstrap/router.php';

try {
    (new App())
        ->run($container, $router);
} catch (Throwable $exception) {
    echo 'An Error occurred ' . PHP_EOL;
    echo $exception->getMessage();
}
