<?php

namespace App;

use App\Application\Services\AbstractCodeAction;
use App\Application\Services\CodeGenerator;
use App\Application\Services\CreatedCodeReceiver;
use App\Infrastructure\Commands\ReceiveCommand;
use App\Infrastructure\Controllers\MessageController;
use App\Infrastructure\Factiories\CodeActionFactory;
use App\Infrastructure\Router;
use DI\Container;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use function DI\factory;

class App
{
    private static $instances = [];
    private $container;
    private $console;

    protected function __construct()
    {
        $this->console = false;
        $this->setContainer();
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

    public function initialize(): void
    {
        if ($this->console) {
            $receiveCommands = $this->container->make(ReceiveCommand::class);
            $receiveCommands->recieve();
            die();
        }
        Router::execute($_SERVER['REQUEST_URI']);
    }


    private function setRouter()
    {
        Router::route('/', function () {
            header('Location: /form');
            die();
        });
        Router::route('/code/add', function () {
            $controller = $this->container->make(MessageController::class);
            $controller->send();
            die();
        });
        Router::route('/form', function () {
            echo file_get_contents('../resources/index.html');
            die();
        });
    }

    public function getContainer()
    {
        return $this->container;
    }

    private function setContainer(): void
    {
        $builder = new \DI\ContainerBuilder();
        $amqpConntection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
        $builder->addDefinitions([
            AMQPStreamConnection::class => factory(function () use ($amqpConntection) {
                return $amqpConntection;
            }),
            CodeGenerator::class => \DI\factory([CodeActionFactory::class, 'createGenerator'])
                ->parameter('connection', $amqpConntection)
                ->parameter('exchange', EXHANGE)
                ->parameter('queue', QUEUE),
            CreatedCodeReceiver::class => \DI\factory([CodeActionFactory::class, 'createReceiver'])
                ->parameter('connection', $amqpConntection)
                ->parameter('exchange', EXHANGE)
                ->parameter('queue', QUEUE),
        ]);
        $this->container = $builder->build();
    }

}