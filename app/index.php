<?php

use App\App;

require_once "vendor/autoload.php";

try {
    $app = new App();
    $app->hello();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
