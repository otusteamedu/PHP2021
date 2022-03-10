<?php

namespace App;

use App\Application\YoutubeAnalyticControllerInterface;
use App\Application\YoutubeChannelControllerInterface;
use App\DTO\Response;
use App\Infrastructure\YoutubeAnalyticController;
use App\Infrastructure\YoutubeChannelController;
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
    private RouteCollector $router;
    private YoutubeChannelControllerInterface $channelController;
    private YoutubeAnalyticControllerInterface $analyticController;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();
        $this->router = $this->container->get(RouteCollector::class);
        $this->channelController =
            $this->container->get(YoutubeChannelController::class);
        $this->analyticController =
            $this->container->get(YoutubeAnalyticController::class);
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

    private function addRoutes(): void
    {
        $this->router->get(
            YoutubeChannelControllerInterface::PATH . '/{id}',
            fn($id) => $this->channelController->get($id)
        );
        $this->router->get(
            YoutubeChannelControllerInterface::PATH,
            fn() => $this->channelController->getAll()
        );
        $this->router->post(
            YoutubeChannelControllerInterface::PATH,
            fn() => $this->channelController->create()
        );
        $this->router->delete(
            YoutubeChannelControllerInterface::PATH,
            fn() => $this->channelController->delete()
        );
        $this->router->get(
            YoutubeAnalyticControllerInterface::PATH . '/{id}',
            fn($id) => $this->analyticController->getTotalLikesViewsByChannel($id)
        );
        $this->router->get(
            YoutubeAnalyticControllerInterface::PATH,
            fn() => $this->analyticController->getTopChannelsWithMaxLikesViewsPercentage()
        );
    }
}
