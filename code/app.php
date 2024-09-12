<?php

use App\App;

require_once './vendor/autoload.php';

try {
    echo $_SERVER['DOCUMENT_ROOT'];
    $app = new App();
    $app->run();
} catch (Exception $e) {

}