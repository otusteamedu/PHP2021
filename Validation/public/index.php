<?php

use App\Http\App;

require __DIR__ . '/../config/app.php';
require __DIR__ . '/../vendor/autoload.php';

try {
    (new App())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}