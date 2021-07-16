<?php

use App\Http\App;

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('ROOT_PATH', dirname(__DIR__));

define('LAYOUTS_PATH', ROOT_PATH . '/resources/layouts/');
define('VIEWS_PATH', ROOT_PATH . '/resources/views/');

require __DIR__ . '/../vendor/autoload.php';

try {
    (new App())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}