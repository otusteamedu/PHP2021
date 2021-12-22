<?php
session_start();

include "../vendor/autoload.php";

use App\Infrastructure\Controllers\FrontController;
use App\Infrastructure\Controllers\MessageAdminController;
use App\Infrastructure\Controllers\MessageController;

include __DIR__ . "\..\config.php";;

$app = require __DIR__ . '/../bootstrap/container.php';


if (strpos($_SERVER['REQUEST_URI'], '/user/register') !== false) {
    $controller = $app->make(FrontController::class);
    $controller->register();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/user/login') !== false) {
    $controller = $app->make(FrontController::class);
    $controller->login();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/indexAdmin') !== false) {
    $controller = $app->make(MessageAdminController::class);
    $controller->index();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/index') !== false) {
    $controller = $app->make(MessageController::class);
    $controller->index();
    return 0;
}

$controller = $app->make(FrontController::class);
$controller->index();

