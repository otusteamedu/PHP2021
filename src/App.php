<?php

namespace App;

use App\Application\Contracts\ServiceInterface;
use App\Application\UseCases\Client;
use App\Application\UseCases\Server;
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
    public function __construct(?string $type = null)
    {
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();

        switch ($type) {
            case ServiceInterface::SERVER:
                $this->service = $this->container->get(Server::class);
                break;
            case ServiceInterface::CLIENT:
                $this->service = $this->container->get(Client::class);
                break;
            default:
                throw new Exception('unknown service type');
        }
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $this->service->execute();
    }
}
