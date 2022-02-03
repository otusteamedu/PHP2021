<?php

namespace App;

use App\Application\MessageController;
use App\Infrastructure\Router;
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
        $this->setRouter();
        Router::execute($_SERVER['REQUEST_URI']);
    }


    private function setRouter()
    {
        Router::route('/', function(){
            header('Location: /form');
            exit();
        });
        Router::route('/code/add', function(){
            $controller = new MessageController();
            $controller->send($_POST['code']);
        });
        Router::route('/form', function(){
            echo file_get_contents('../resources/index.html');
        });
    }

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