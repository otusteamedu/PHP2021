<?php

namespace App;

use App\Application\DTO\QueueConnectionDTO;
use App\Application\Services\AbstractCodeAction;
use App\Application\Services\CodeGenerator;
use App\Application\Services\CreatedCodeReceiver;
use App\Infrastructure\Commands\ReceiveCommand;
use App\Infrastructure\Configuration;
use App\Infrastructure\Controllers\FormCodeController;
use App\Infrastructure\Controllers\HomePageController;
use App\Infrastructure\Controllers\MessageController;
use App\Infrastructure\Providers\DIProvider;
use App\Infrastructure\Router;
use DI\Container;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Symfony\Component\Config\Definition\Processor;
use function DI\factory;

class App
{
    private static $instances = [];
    private $container;
    private $console;

    protected function __construct()
    {
        $this->console = false;
        $this->registerBaseServiceProviders();
        $this->setRouter();
    }

    public function inConsole()
    {
        $this->console = true;
        return $this;
    }

    public static function getInstance(): App
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function initialize()
    {
        if ($this->console) {
            $receiveCommands = $this->container->make(ReceiveCommand::class);
            $receiveCommands->receive();
        }
        return Router::execute($_SERVER['REQUEST_URI']);
    }


    private function setRouter()
    {
        Router::route('/', function () {
            /**
             * @var $controller HomePageController
             */
            $controller = $this->container->make(HomePageController::class);
            $controller->index();
            return $controller->index();
        });
        Router::route('/code/add', function () {
            /**
             * @var $controller MessageController
             */
            $controller = $this->container->make(MessageController::class);
            return $controller->send();
        });
        Router::route('/form', function () {
            /**
             * @var $controller FormCodeController
             */
            $controller = $this->container->make(FormCodeController::class);
            return $controller->index();
        });
    }


    private function registerBaseServiceProviders(): void
    {
        $builder = new \DI\ContainerBuilder();
        $servicesProviders = [new DIProvider()];
        foreach ($servicesProviders as $servicesProvider) {
            $servicesProvider->register();
            $builder->addDefinitions($servicesProvider->getDefinitions());
        }
        $this->container = $builder->build();
    }

}