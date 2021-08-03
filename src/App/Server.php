<?php


namespace App\App;


use App\Event\Delivery\Http\Handler;
use App\Event\UseCase\UseCase;
use App\Event\Repository\RedisEventRepository;
use Bramus\Router\Router;
use Exception;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Route;
use Phroute\Phroute\RouteCollector;

class Server
{
    protected RouteCollector $router;

    protected array $container;

    public function __construct($container)
    {
        $this->router = new RouteCollector();
        $this->container = $container;
    }

    public function run()
    {
        $rep = new RedisEventRepository($this->container['redis'] ?? null);

        // EventHandler
        new Handler(new UseCase($rep), $this->router);

        try {
            $routeDispatcher = New Dispatcher($this->router->getData());
            $components = parse_url($_SERVER['REQUEST_URI']);
            $routeDispatcher->dispatch($_SERVER['REQUEST_METHOD'], $components['path'] ?? '');
        } catch (Exception $e) {
            http_response_code(404);
            echo 'Method not founded. ' . $e->getMessage();
        }
    }
}