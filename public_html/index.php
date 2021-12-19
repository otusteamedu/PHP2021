<?php
session_start();

include "../vendor/autoload.php";

use App\Controllers\MessageAdminController;
use App\Controllers\FrontController;

include __DIR__ . "\..\config.php";

if (strpos($_SERVER['REQUEST_URI'], '/data/fill') !== false) {
    include "eloquent/fill.php";
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/user/register') !== false) {
    $controller = new \App\Controllers\FrontController();
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