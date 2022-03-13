<?php

namespace App\Application\UseCases;

use App\Application\Contracts\EventControllerInterface;
use App\Application\Contracts\ServiceInterface;
use App\DTO\Response;
use App\Utils\HttpOutput;
use Exception;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

class Client implements ServiceInterface
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
    public function execute(): void
    {
        $this->addRoutes();
        $dispatcher = new Dispatcher($this->router->getData());
        try {
            $resp = $dispatcher->dispatch(
                $_SERVER['REQUEST_METHOD'],
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            );
            HttpOutput::send($resp);
        } catch (HttpMethodNotAllowedException $e) {
            $resp = new Response($e->getMessage(), 405);
            HttpOutput::send($resp);
        } catch (HttpRouteNotFoundException $e) {
            $resp = new Response($e->getMessage(), 404);
            HttpOutput::send($resp);
        } catch (Exception $e) {
            $resp = new Response($e->getMessage(), 400);
            HttpOutput::send($resp);
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
