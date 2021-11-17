<?php

declare(strict_types=1);

namespace Sources\Services;

use Sources\Exceptions\HttpException;

class FrontRouter
{
    const CONTROLLER_PATH = 'Sources\\Controllers\\';

    private string $controller = self::CONTROLLER_PATH . 'IndexController';
    private string $action = 'actionIndex';

    public function __construct($controller = null, $action = null)
    {
        if (!empty($controller) && !empty($action)) {
            $this->controller = $controller;
            $this->action = $action;
        } else {
            $this->parseUri();
        }
    }

    protected function parseUri(): void
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if (!empty($path)) {
            $pathExplode = explode('/', $path);
            $this->setController($pathExplode[0]);
            $this->setAction($pathExplode[1]);
        }
    }

    public function setController(string $controllerName): void
    {
        $controller = self::CONTROLLER_PATH . ucfirst(strtolower($controllerName)) . 'Controller';

        if (!class_exists($controller)) {
            throw new HttpException('Requested controller not found', 404);
        }

        $this->controller = $controller;
    }

    public function setAction(string $actionName): void
    {
        $action = 'action' . ucfirst(strtolower($actionName));

        if (!method_exists($this->controller, $action)) {
            throw new HttpException('Requested controller action not found', 404);
        }

        $this->action = $action;
    }

    public function forward(): void
    {
        [new $this->controller, $this->action]();
    }
}