<?php

use App\App;

require_once '../vendor/autoload.php';
require_once '../config/config.php';

$app = App::getInstance();

try {
    $app->initialize();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
