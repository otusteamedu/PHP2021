<?php

use App\App;

require_once 'vendor/autoload.php';
require_once 'config/config.php';

$app = App::getInstance();

try {
    $app->inConsole()->initialize();
} catch (Exception $exception) {
    echo $exception->getMessage();
}



