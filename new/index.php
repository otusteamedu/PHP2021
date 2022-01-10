<?php

require_once('vendor/autoload.php');

use App\App;

$emailVar = $argv[1];

try {

    if(!isset($emailVar)|empty($emailVar)){
        throw new Exception('Введите email первым аргументом');
    }

    $app = new App($emailVar);
    $app->run();

} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}