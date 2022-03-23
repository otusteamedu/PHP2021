<?php

namespace App\Infrastructure;

use App\Application\Contracts\EventControllerInterface;
use App\Application\Contracts\HttpHandlerInterface;
use App\DTO\EventResponse;
use App\Exception\EventNotFoundException;
use App\Utils\EventOutput;
use Exception;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

class HttpHandler implements HttpHandlerInterface
{
    private RouteCollector $router;
    private EventControllerInterface $eventController;

    /**
     * @throws Exception
     */
    public function __construct(
        RouteCollector $router,
        EventControllerInterface $eventController
    ) {
        $this->router = $router;
        $this->eventController = $eventController;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->addRoutes();
        $dispatcher = new Dispatcher($this->router->getData());
        try {
            $resp = $dispatcher->dispatch(
                $_SERVER['REQUEST_METHOD'],
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            );
            EventOutput::send($resp);
        } catch (HttpMethodNotAllowedException $e) {
            $resp = new EventResponse($e->getMessage(), 405);
            EventOutput::send($resp);
        } catch (HttpRouteNotFoundException|EventNotFoundException $e) {
            $resp = new EventResponse($e->getMessage(), 404);
            EventOutput::send($resp);
        } catch (Exception $e) {
            $resp = new EventResponse($e->getMessage(), 400);
            EventOutput::send($resp);
        }
    }

    private function addRoutes(): void
    {
        $this->router->get(
            EventControllerInterface::PATH . '/{id}',
            fn($id) => $this->eventController->get($id)
        );
        $this->router->post(
            EventControllerInterface::PATH,
            fn() => $this->eventController->create()
        );
    }
}
