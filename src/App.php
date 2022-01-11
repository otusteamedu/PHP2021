<?php

namespace App;

use App\Application\ProductFactoryInterface;
use App\Application\Strategies\Strategy;
use App\Application\Visitors\Visitor;
use App\Domain\VisitorInterface;
use App\Infrastructure\Facades\KitchenFacade;
use App\Infrastructure\Factories\ItalianProductFactory;
use DI\Container;
use function DI\factory;

class App
{
    private static $instances = [];
    private ProductFactoryInterface $productFactory;
    private Strategy $productStrategy;
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
        $kitchen = new KitchenFacade();
        $productType = strtolower($_GET['product']);
        $fillings = $_GET['fillings'];
        $kitchen->makeFood($productType, $fillings);
    }

    public function getContainer() :Container
    {
        return $this->container;
    }

    private function setContainer() :void
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions([
            ProductFactoryInterface::class => factory(function () {
                return new ItalianProductFactory();
            }),
            VisitorInterface::class => factory(function () {
                return new Visitor();
            }),
        ]);
        $this->container = $builder->build();
    }

}