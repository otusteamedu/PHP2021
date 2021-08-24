<?php

namespace MySite\bootstrap;

use League\Container\Container;
use MySite\app\ServiceProvider\ZendDiactorosServiceProvider;

/**
 * Class AppContainer
 * @package MySite\bootstrap
 */
class AppContainer
{
    /**
     * @return Container
     */
    public function __invoke()
    {
        $container = new Container();

        $container
            ->addServiceProvider(ZendDiactorosServiceProvider::class);

        return $container;
    }
}



