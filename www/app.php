<?php
require_once './vendor/autoload.php';

use Src\App;

const SOCKET_PATH = '/tmp/44444';

try {
    $app = new App();
    $app->run();
} catch(Exception $exception){
    echo $exception;
}