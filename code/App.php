<?php

require 'vendor/autoload.php';

use App2\App2;

try {
    $app = new App2();
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}