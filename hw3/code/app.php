<?php

use App\App;

require_once 'vendor/autoload.php';

try {
    $app = new App();
    $app->run($argv[1]);
} catch(Exception $e) {
    echo $e->getMessage();
}