<?php

declare(strict_types=1);

namespace MySite;

use MySite\bootstrap\AppContainer;
use MySite\bootstrap\AppRouter;

/**
 * Class App
 * @package MySite
 */
final class App
{

    /**
     * single entry point into application
     *
     */
    public function run(): void
    {
        $container = (new AppContainer())();
        $router = (new AppRouter())($container);

        $response = $router->dispatch(
            $container->get('Zend\Diactoros\ServerRequest'),
            $container->get('Zend\Diactoros\Response')
        );
        $container
            ->get('Zend\Diactoros\Response\SapiEmitter')
            ->emit($response);
    }
}
