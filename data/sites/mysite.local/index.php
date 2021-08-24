<?php

include __DIR__ . '/../vendor/autoload.php';

use MySite\App;

try {
    (new App())->run();
} catch (Throwable $exception) {
    echo 'An Error occurred ' . PHP_EOL;
    echo $exception->getMessage();
}
