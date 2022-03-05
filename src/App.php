<?php

namespace App;

use App\Application\EventControllerInterface;
use App\DTO\Response;
use DI\Container;
use DI\ContainerBuilder;
use Exception;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

class App
{
    private Container $container;
    private EventControllerInterface $eventController;
    private RouteCollector $router;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();
        $this->eventController =
            $this->container->get(EventControllerInterface::class);
        $this->router = $this->container->get(RouteCollector::class);
    }

    public function run(): void
    {
        $this->addEventRoutes();
        $dispatcher = new Dispatcher($this->router->getData());
        try {
            $resp = $dispatcher->dispatch(
                $_SERVER['REQUEST_METHOD'],
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            );
            Output::send($resp);
        } catch (HttpMethodNotAllowedException $e) {
            $resp = new Response($e->getMessage(), 405);
            Output::send($resp);
        } catch (HttpRouteNotFoundException $e) {
            $resp = new Response($e->getMessage(), 404);
            Output::send($resp);
        } catch (Exception $e) {
            $resp = new Response($e->getMessage(), 400);
            Output::send($resp);
        }
    }

    private function addEventRoutes(): void
    {
        $this->router->get(
            EventControllerInterface::PATH,
            fn() => $this->eventController->get()
        );
        $this->router->post(
            EventControllerInterface::PATH,
            fn() => $this->eventController->create()
        );
        $this->router->delete(
            EventControllerInterface::PATH,
            fn() => $this->eventController->delete()
        );
    }
}
