<?php

declare(strict_types=1);

namespace MySite;

use League\Container\ContainerInterface;
use League\Route\RouteCollectionInterface;

/**
 * Class App
 * @package MySite
 */
final class App
{

    /**
     * single entry point into application
     *
     * @param ContainerInterface $container
     * @param RouteCollectionInterface $router
     */
    public function run(ContainerInterface $container, RouteCollectionInterface $router): void
    {
        $response = $router->dispatch(
            $container->get('Zend\Diactoros\ServerRequest'),
            $container->get('Zend\Diactoros\Response')
        );
        $container
            ->get('Zend\Diactoros\Response\SapiEmitter')
            ->emit($response);
    }
}
