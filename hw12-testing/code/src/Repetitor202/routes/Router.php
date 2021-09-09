<?php

namespace Repetitor202\routes;

use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Route\Router as LeagueRoute;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\JsonStrategy;
use Symfony\Component\Yaml\Yaml;

class Router
{
    private array $routes;
    private ServerRequest $request;
    private LeagueRoute $router;

    public function __construct()
    {
        $this->routes = Yaml::parseFile(dirname(__DIR__) . '/routes/routing.yml');

        $this->request = ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );

        $responseFactory = new ResponseFactory();
        $container = new Container;
        $container->delegate(
//            new League\Container\ReflectionContainer()
            new ReflectionContainer()
        );
        $strategy = (new JsonStrategy($responseFactory))->setContainer($container);
//        $strategy = (new ApplicationStrategy)->se;

        $this->router = new LeagueRoute();
        $this->router->setStrategy($strategy);

        foreach ($this->routes as $route) {
            $this->router->map(
                $route['method'],
                $route['path'],
                '\Repetitor202\controllers\\' . $route['resource'] . '::' . $route['action']
            );
        }
    }

    public function getResponse(): void
    {
        $response = $this->router->dispatch($this->request);
        (new SapiEmitter())->emit($response);
    }
}