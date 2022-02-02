<?php

namespace App;

use App\Application\ProductFactoryInterface;
use App\Application\Strategies\Strategy;
use App\Application\Visitors\Visitor;
use App\Domain\VisitorInterface;
use App\Infrastructure\Facades\KitchenFacade;
use App\Infrastructure\Factories\ItalianProductFactory;
use DI\Container;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use function DI\factory;

class App
{
    private static $instances = [];
    private $container;

    protected function __construct()
    {
        $this->setContainer();
    }

    public static function getInstance(): App
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function initialize() :void
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'user', 'password');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);
        $callback = function ($msg) {
            echo ' recieved: ' . $msg->body . '\n';
        };
        $channel->basic_consume('hello', false, true, false, false, $callback);
        while (count($channel->callbacks)) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
//        $kitchen = new KitchenFacade();
//        $productType = strtolower($_GET['product']);
//        $fillings = $_GET['fillings'];
//        $kitchen->makeFood($productType, $fillings);
    }

//    public function getContainer() :Container
//    {
////        return $this->container;
//    }

    private function setContainer() :void
    {
//        $builder = new \DI\ContainerBuilder();
//        $builder->addDefinitions([
//            ProductFactoryInterface::class => factory(function () {
//                return new ItalianProductFactory();
//            }),
//            VisitorInterface::class => factory(function () {
//                return new Visitor();
//            }),
//        ]);
//        $this->container = $builder->build();
    }

}