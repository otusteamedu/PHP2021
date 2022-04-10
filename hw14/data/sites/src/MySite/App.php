<?php

declare(strict_types=1);

namespace MySite;

use MySite\bootstrap\Container\AppContainer;
use MySite\bootstrap\Router\AppRouter;

/**
 * Class App
 * @package MySite
 */
final class App
{
    /**
     * single entry point into application
     */
    public function run(): void
    {
        $container = (new AppContainer())->getContainer();
        $router = (new AppRouter($container));

        $router->getResponse();
    }
}
