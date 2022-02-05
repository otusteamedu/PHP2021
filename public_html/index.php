<?php

use App\App;

require_once '../vendor/autoload.php';

$app = App::getInstance();

try {
    echo $app->initialize();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
