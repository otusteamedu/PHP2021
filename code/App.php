<?php

require 'vendor/autoload.php';

use App\App;

try {
    $app = new App();
    $app->run($argv);
} catch (Exception $e) {
    echo $e->getMessage();
}