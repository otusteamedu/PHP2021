<?php

/**
 * web routers
 */

use Bramus\Router\Router;

$router = new Router();

$router->get('/check', 'Yu2ry\App\Http\Controllers\HW4Controller@check');

$router->run();
