<?php

namespace App;

use App\Infrastructure\Controllers\FrontController;
use App\Infrastructure\Controllers\MessageAdminController;
use App\Infrastructure\Controllers\MessageController;

class App
{
    public function __construct()
    {
        session_start();
        $this->bindBaseRoutes();
    }

    private function bindBaseRoutes()
    {
        global $container;
        if (strpos($_SERVER['REQUEST_URI'], '/user/register') !== false) {
            $controller = $container->make(FrontController::class);
            $controller->register();
            return 0;
        }

        if (strpos($_SERVER['REQUEST_URI'], '/user/login') !== false) {
            $controller = $container->make(FrontController::class);
            $controller->login();
            return 0;
        }

        if (strpos($_SERVER['REQUEST_URI'], '/message/indexAdmin') !== false) {
            $controller = $container->make(MessageAdminController::class);
            $controller->index();
            return 0;
        }

        if (strpos($_SERVER['REQUEST_URI'], '/message/index') !== false) {
            $controller = $container->make(MessageController::class);
            $controller->index();
            return 0;
        }

        $controller = $container->make(FrontController::class);
        $controller->index();
    }

    private function configPath()
    {
        return __DIR__ . "\..\config.php";
    }
}