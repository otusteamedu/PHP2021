<?php
require_once './vendor/autoload.php';

use Src\App;

//set_error_handler(function ($e, $a) {
//    echo 'Произошла ошибка во время работы с сокетом', PHP_EOL;
//    exit();
//}, E_WARNING);

const SOCKET_PATH = '/tmp/44444';

try {
    $app = new App();
    $app->run();
} catch(Exception $exception){
    echo $exception;
}