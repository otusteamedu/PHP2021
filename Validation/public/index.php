<?php

use App\Http\App;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

try {
    (new App())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}