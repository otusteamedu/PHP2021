<?php

namespace App;

use App\Application\Services\AuthInterface;
use App\Application\Services\ViewMapperInterface;
use App\Infrastructure\Controllers\FrontController;
use App\Infrastructure\Controllers\MessageAdminController;
use App\Infrastructure\Controllers\MessageController;
use function DI\factory;

class App
{
    private $container;

    public function __construct()
    {
        session_start();
        $this->setContainer();
        $this->bindBaseRoutes();
    }

    private function setContainer()
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions([
            AuthInterface::class => factory(function () {
                return new \App\Infrastructure\Models\Auth();
            }),
            ViewMapperInterface::class => factory(function () {
                return new \App\Infrastructure\Models\View();
            }),
        ]);
        $builder->useAutowiring(true);
        $builder->useAnnotations(true);
        $this->container = $builder->build();
    }

    private function bindBaseRoutes()
    {
        if (strpos($_SERVER['REQUEST_URI'], '/user/register') !== false) {
            $controller = $this->container->make(FrontController::class);
            $controller->register();
            return true;
        }

        if (strpos($_SERVER['REQUEST_URI'], '/user/login') !== false) {
            $controller = $this->container->make(FrontController::class);
            $controller->login();
            return true;
        }

        if (strpos($_SERVER['REQUEST_URI'], '/message/indexAdmin') !== false) {
            $controller = $this->container->make(MessageAdminController::class);
            $controller->index();
            return true;
        }

        if (strpos($_SERVER['REQUEST_URI'], '/message/index') !== false) {
            $controller = $this->container->make(MessageController::class);
            $controller->index();
            return true;
        }

        $controller = $this->container->make(FrontController::class);
        $controller->index();
    }
}