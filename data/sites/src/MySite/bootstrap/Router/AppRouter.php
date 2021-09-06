<?php

declare(strict_types=1);

namespace MySite\bootstrap\Router;

use Closure;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\Container;
use League\Route\Router as LeagueRoute;
use League\Route\Strategy\JsonStrategy;
use Symfony\Component\Yaml\Yaml;

/**
 * Class AppRouter
 * @package MySite\bootstrap\Router
 */
class AppRouter
{
    /**
     * @var ServerRequest
     */
    private ServerRequest $request;

    /**
     * @var LeagueRoute
     */
    private LeagueRoute $router;

    /**
     * AppRouter constructor.
     * @param Container $container
     */
    public function __construct(
        private Container $container
    ) {
        $this->request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $this->initRouter();
        $this->prepareRoutes();
    }

    private function initRouter()
    {
        $this->router = new LeagueRoute();

        $strategy = new JsonStrategy(
            new ResponseFactory()
        );

        $strategy->setContainer($this->container);

        $this->router->setStrategy($strategy);
    }

    private function prepareRoutes()
    {
        $routes = Yaml::parseFile(
            getenv('ROOT_PATH') . '/' . getenv('DOMAIN') . '_routes.yml'
        );
        if (is_array($routes)) {
            array_map($this->mapRoute(), $routes);
        }
    }

    /**
     * @return Closure
     */
    private function mapRoute(): Closure
    {
        return fn($route) => $this->router->map(
            $route['method'],
            $route['path'],
            'MySite\app\Controllers\\' . $route['resource'] . '::' . $route['action']
        );
    }

    public function getResponse(): void
    {
        $response = $this
            ->router
            ->dispatch($this->request);

        (new SapiEmitter())->emit($response);
    }
}
