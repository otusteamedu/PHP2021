<?php

use App\Application\Contracts\ServiceInterface;
use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;

class App
{
    private Container $container;
    private ServiceInterface $service;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct()
    {
        $this->container = (new ContainerBuilder())
            ->addDefinitions('config/config.php')
            ->build();
        $this->service = $this->container->get(ServiceInterface::class);
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->service->execute();
    }


}