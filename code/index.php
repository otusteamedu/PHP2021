<?php

use App\App;

require_once('vendor/autoload.php');

define('ROOT', $_SERVER['DOCUMENT_ROOT']); //полный путь к файлу

try {
    $app = new App();
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}