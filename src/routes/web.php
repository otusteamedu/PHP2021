<?php

/**
 * web routers
 */

use Bramus\Router\Router;

$router = new Router();

$router->mount('/check', function () use ($router) {
    $router->get('email', 'Yu2ry\App\Http\Controllers\HW5Controller@checkEmail');
    $router->get('emails', 'Yu2ry\App\Http\Controllers\HW5Controller@checkEmails');
});

$router->run();
