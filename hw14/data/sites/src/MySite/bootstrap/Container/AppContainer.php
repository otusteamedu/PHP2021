<?php

declare(strict_types=1);

namespace MySite\bootstrap\Container;

use League\Container\Container;

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
