<?php
declare(strict_types=1);

namespace App\Infrastructure\Components;

use App\Application\Service\RequestService;
use Exception;
use FastRoute;

class Router
{
    private string $routsPath;

    public function __construct(){

        $this->routsPath = ROOT .'/config/routes.php';

        //header("Access-Control-Allow-Origin: *");
       // header("Access-Control-Allow-Methods: *");
       // header("Content-Type: application/json");
    }

    public function actionName(string $method,array $params):string
    {
        $res ='';
        switch ($method) {
            case 'GET':
                $res = (!empty($params))? 'actionView': 'actionIndex';
                break;
            case 'POST':
                $res = 'actionCreate';
                break;

        }

        return $res;
    }

    public function run():void
    {

        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            include($this->routsPath);
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];


        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);

        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);


        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                http_response_code(404);
                throw new Exception('404 Not Found');

            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                http_response_code(405);
                throw new Exception('405 Method Not Allowed');

            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars

                $controllerName = "App\Infrastructure\Http\\".$handler."Controller";
                $serviceName = "App\Application\Service\\".$handler."Service";
                $repositoryName = "App\Infrastructure\Repository\\".$handler."Repository";
                $daoName = "App\Infrastructure\Dao\\".$handler."Dao";

                $app = new $controllerName(
                    new $serviceName(
                        new $repositoryName()
                    )
                );

                $actionName = $this->actionName($httpMethod,$vars);

                (!empty($vars))?$app->$actionName($vars):$app->$actionName();

                break;
        }

    }

}

