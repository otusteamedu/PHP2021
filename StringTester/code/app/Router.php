<?php


namespace AppCore;
use AppCore\Configuration\ConfigParserInterface;
use Symfony\Component\HttpFoundation\Request;
class Router
{

    protected static $routesParamName = "routes";
    protected ConfigParserInterface $parser;
    protected Request $request;

    protected static Router $instance;


    protected string $controller_name;
    protected string $action_name;

    protected function __construct(ConfigParserInterface $parser, Request $request) {
       $this->parser = $parser;
       $this->request = $request;
       $this->matchRequest();
    }

    public static function getInstance(ConfigParserInterface $parser, Request $request) : Router {
        if (empty(static::$instance)) {
            static::$instance = new Router($parser, $request);
        }
        return static::$instance;
    }

    protected function matchRequest() {
        $path = $this->request->getPathInfo();
        $config = $this->parser->getConfigData();

        $config[static::$routesParamName]["_default"] = [
            'path' => "/",
            'controller' => $config["defaultController"] ?? false,
            'action' => $config["defaultAction"] ?? false
        ];

        $routes = $config[static::$routesParamName] ?? [];
        array_walk($routes, function (&$route, &$routeName) {
            $route = $route['path'] ?? null;
        });
        $routes = array_filter($routes);
        $pathRouteMapping = array_flip($routes);
        //$availablePaths = array_values($pathRouteMapping);
        if (isset($pathRouteMapping[$path])) {
            $routeName = $pathRouteMapping[$path];
            $this->controller_name = $config[static::$routesParamName][$routeName]['controller'] ?? "";
            $this->action_name = $config[static::$routesParamName][$routeName]['action'] ?? "";
        } else {
            if (isset($config["defaultController"]) && isset($config["notFoundAction"])) {
                $this->controller_name = $config["defaultController"];
                $this->action_name = $config["notFoundAction"];
            } else {
                throw new \Exception("Route is undefined for path ". $path);
            }
        }
    }

    public function getControllerName() : string {
        return $this->controller_name;
    }

    public function getActionName() : string {
        return $this->action_name;
    }

    private function __clone() {

    }
}