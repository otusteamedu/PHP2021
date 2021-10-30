<?php
require_once './vendor/autoload.php';

use Src\App;

const SOCKET_NAME = '34234';
const SOCKET_DIR = '/tmp';

try {
    $app = new App();
    $app->run();
} catch(Exception $exception){
    echo $exception;
}