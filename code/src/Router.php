<?php

namespace Vshepelev\App;

use InvalidArgumentException;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function getAction(string $method, string $uri): ?callable
    {
        $method = strtolower($method);
        $route = $this->routes[$method][$uri] ?? null;

        if (!isset($route)) {
            return null;
        }

        if (count($route) !== 2) {
            throw new InvalidArgumentException("Incorrect route configuration");
        }

        [$controller, $action] = $route;

        if (!isset($controller) || !class_exists($controller)) {
            throw new InvalidArgumentException("Incorrect controller for current route");
        }

        if (!isset($action) || !method_exists($controller, $action)) {
            throw new InvalidArgumentException("Incorrect action for current route");
        }

        return [new $controller, $action];
    }
}
