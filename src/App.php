<?php

namespace App;

use App\Application\ProductFactoryInterface;
use App\Application\Strategies\BurgerStrategy;
use App\Application\Strategies\HotDogStrategy;
use App\Application\Strategies\SandwichStrategy;
use App\Application\Strategies\Strategy;
use App\Application\Visitors\Visitor;
use App\Domain\VisitorInterface;
use App\Infrastructure\Factories\ItalianProductFactory;
use function DI\factory;

class App
{
    private ProductFactoryInterface $productFactory;
    private Strategy $productStrategy;
    private $strategies;
    public $container;

    public function __construct()
    {
        $this->setContainer();
        $this->setStrategies();
    }

    private function setContainer()
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

    private function setStrategies()
    {
        $this->strategies = [
            'burger' => function () {
                return $this->container->make(BurgerStrategy::class);
            },
            'hotdog' => function () {
                return $this->container->make(HotDogStrategy::class);
            },
            'sandwich' => function () {
                return $this->container->make(SandwichStrategy::class);
            },
        ];
    }

    public function initialize()
    {
        $productType = strtolower($_GET['product']);
        $fillings = $_GET['fillings'];
        $this->makeProduct($productType, $fillings);
    }

    private function makeProduct($productType, $fillings)
    {
        if (!isset($this->strategies[$productType])) throw new \Exception('this type does not exists');
        $this->setStrategy($this->strategies[$productType]());
        $this->productStrategy->make($fillings);
    }

    private function setStrategy(Strategy $strategy)
    {
        $this->productStrategy = $strategy;
    }
}