<?php

namespace App\Infrastructure;

use App\Application\Contracts\EventControllerInterface;
use App\Application\Contracts\HttpHandlerInterface;
use App\DTO\EventResponse;
use App\Utils\EventOutput;
use Exception;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

class HttpHandler implements HttpHandlerInterface
{
    private RouteCollector $routeCollector;
    private EventControllerInterface $eventController;

    public function __construct(
        RouteCollector $routeCollector,
        EventControllerInterface $eventController
    )
    {
        $this->routeCollector = $routeCollector;
        $this->eventController = $eventController;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->addRoutes();
        $dispatcher = new Dispatcher($this->routeCollector->getData());

        try {
            $response = $dispatcher->dispatch(
                $_SERVER['REQUEST_METHOD'],
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            );
        } catch (HttpMethodNotAllowedException $e) {
            $response = new EventResponse($e->getMessage(), 405);
        } catch (HttpRouteNotFoundException $e) {
            $response = new EventResponse($e->getMessage(), 404);
        } catch (Exception $e) {
            $response = new EventResponse($e->getMessage(), 400);
        } finally {
            EventOutput::send($response);
        }
    }

    /**
     * @return void
     */
    private function addRoutes(): void
    {
        $this->routeCollector->get(
            "{EventControllerInterface::PATH}/{id}",
            fn($id) => $this->eventController->get($id)
        );
        $this->routeCollector->post(
            EventControllerInterface::PATH,
            fn() => $this->eventController->create()
        );
    }

}