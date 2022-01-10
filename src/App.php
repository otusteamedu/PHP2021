<?php

namespace App;

use App\Application\ProductFactoryInterface;
use App\Application\Strategies\BurgerStrategy;
use App\Application\Strategies\HotDogStrategy;
use App\Application\Strategies\SandwichStrategy;
use App\Application\Strategies\Strategy;

class App
{
    private ProductFactoryInterface $productFactory;
    private Strategy $productStrategy;
    private $strategies;

    public function __construct()
    {
        global $container;
        $this->strategies = [
            'burger' => function () use ($container){
                return $container->make(BurgerStrategy::class);
            },
            'hotdog' => function () use ($container){
                return $container->make(HotDogStrategy::class);
            },
            'sandwich' => function () use ($container){
                return $container->make(SandwichStrategy::class);
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