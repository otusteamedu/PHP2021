<?php

require '../vendor/autoload.php';

use App\App;

try {
    $app = new App();
    echo $app->run() . PHP_EOL;
} catch (Exception $e) {
    echo $e;
}