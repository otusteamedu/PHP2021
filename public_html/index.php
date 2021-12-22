<?php
session_start();

include "../vendor/autoload.php";

use App\Infrastructure\Controllers\FrontController;

include __DIR__ . "\..\config.php";;

$app = require __DIR__ . '/../bootstrap/container.php';

var_dump($app->make(FrontController::class));

if (strpos($_SERVER['REQUEST_URI'], '/user/register') !== false) {
    $controller = $app->make(FrontController::class);
    $controller->register();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/user/login') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->login();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/indexAdmin') !== false) {
    $controller = new MessageAdminController();
    $controller->index();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/index') !== false) {
    $controller = new \App\Controllers\MessageController();
    $controller->index();
    return 0;
}

$controller = new FrontController();
$controller->index();

