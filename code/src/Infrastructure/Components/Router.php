<?php
declare(strict_types=1);

namespace App\Infrastructure\Components;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = include($_SERVER['DOCUMENT_ROOT']."/config/routes.php");
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'],'/');
        }

        return '';
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $url = $this->getUrl();

        foreach ($this->routes as $pattern => $route) {
            if (preg_match("~$pattern~",$url)) {
                $internalRoute = preg_replace("~$pattern~", $route, $url);
                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($segments));
                $controllerFile = $_SERVER['DOCUMENT_ROOT'] . "/src/Infrastructure/Controllers/{$controllerName}.php";
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                    $controllerName = "App\Infrastructure\Controllers\\".$controllerName;
                    $controllerObject = new $controllerName();

                    if (method_exists($controllerObject, $actionName)) {
                        $result = call_user_func_array([$controllerObject, $actionName], $segments);
                        if ($result !== null) break;
                    }
                }
            }
        }
    }
}