<?php
require __DIR__ . '/../vendor/autoload.php';

use Sources\App;
use Sources\Exceptions\HttpException;

try {
    $app = new App();
    $app->run();
} catch (HttpException $e) {
    http_response_code($e->getCode());
    echo $e->getMessage();
} catch (\Exception $e) {
    echo $e->getMessage();
}