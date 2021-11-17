<?php
require __DIR__ . '/../vendor/autoload.php';

use Sources\App;

try {
    $app = new App();
    $app->run();
} catch (\Exception $e) {
    echo PHP_EOL . $e->getMessage() . PHP_EOL . PHP_EOL;
}