<?php
require_once './vendor/autoload.php';

use Src\App;

try {
    $app = new App();
    $app->run();
} catch(Exception $exception){
    echo $exception;
}