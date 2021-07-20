<?php

namespace App\Helpers\Contracts;

use App\Http\Router;

interface ControllerDispatcher
{
    public function dispatch(Router $router, $controller, $method);

}