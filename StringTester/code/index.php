<?php
require __DIR__ . '/vendor/autoload.php';

use AppCore\App\App;

try {
    App::run();
} catch (\Exception $e) {
    echo $e->getMessage();
}