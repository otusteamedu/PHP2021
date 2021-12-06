<?php

require_once 'vendor/autoload.php';

use Vshepelev\App\App;

try {
    (new App())->run();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}