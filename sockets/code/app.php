<?php

use App\App;

require_once('vendor/autoload.php');

try {
    if(isset($argv[1]) && in_array($argv[1],['client', 'server'])){
        $app = new App($argv[1]);
        $app->run();
        throw new Exception('Введите название сервиса первым аргументом');
    }
    echo 'Try again and pass parameter server or client'.PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
}