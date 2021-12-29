<?php

declare(strict_types=1);

namespace MySite\bootstrap\Router;

use League\Container\Container;
use MySite\app\Controllers\IndexController;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\FastFoodFactory;

/**
 * Class AppContainer
 * @package MySite\bootstrap\Router
 */
class AppContainer
{

    /**
     * @var Container
     */
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
