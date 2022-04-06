#!/usr/local/bin/php

<?php
require "vendor/autoload.php";

use Ivanboriev\SocketChat\App;

$app = new App();

try {
    $app->run($argv[1]);
} catch (Exception $e) {
    $app->error($e->getMessage());
    echo "asd";
}
