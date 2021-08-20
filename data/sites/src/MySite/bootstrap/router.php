<?php

use League\Container\Container;
use League\Container\ContainerInterface;
use League\Route\RouteCollection;
use MySite\app\Controllers\IndexController;
use MySite\app\Controllers\ParserController;

$router = new RouteCollection(
    ($container instanceof ContainerInterface) ? $container : new Container()
);

$router
    ->map('GET', '/', [IndexController::class, 'index']);
$router->map('GET', '/parse_channel', [ParserController::class, 'parseChannel']);

return $router;
