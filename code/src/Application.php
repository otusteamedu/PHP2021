<?php

declare(strict_types=1);

namespace Vshepelev\App;

use InvalidArgumentException;
use Vshepelev\App\Response\Response;
use Vshepelev\App\Response\HttpStatus;

class Application
{
    public function handle(Request $request): Response
    {
        if (!$action = $this->getActionFromRouter($request->method(), $request->uri())) {
            return new Response('Route not found', HttpStatus::NOT_FOUND);
        }

        return $action($request);
    }

    private function getActionFromRouter(string $method, string $uri): ?callable
    {
        $router = include '../routes.php';
        $method = strtolower($method);
        $route = $router[$method][$uri] ?? null;

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
