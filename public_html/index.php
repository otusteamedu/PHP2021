<?php

use App\App;

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once 'functions.php';

$app = App::getInstance();

try {
    echo $app->initialize();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
