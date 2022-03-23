<?php

namespace App;

use App\Application\Contracts\ServiceInterface;
use DI\Container;
use DI\ContainerBuilder;
use Exception;

class App
{
    private Container $container;
    private ServiceInterface $service;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();
        $this->service = $this->container->get(ServiceInterface::class);
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->service->execute();
    }
}
