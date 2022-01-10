<?php

namespace App;


use App\Application\Strategies\BurgerStrategy;
use App\Application\Strategies\HotDogStrategy;
use App\Application\Strategies\SandwichStrategy;
use App\Application\Strategies\Strategy;
use App\Infrastructure\Factories\ProductFactoryInterface;

class App
{
    private ProductFactoryInterface $productFactory;
    private Strategy $productStrategy;

    public function initialize()
    {
        $productType = strtolower($_GET['product']);
        global $container;
        switch ($productType) {
            case 'burger':
                $this->productStrategy = $container->make(BurgerStrategy::class);
                break;
            case 'hotdog':
                $this->productStrategy = $container->make(HotDogStrategy::class);
                break;
            case 'sandwich':
                $this->productStrategy = $container->make(SandwichStrategy::class);
                break;
            default:
                throw new \Exception('this type does not exists');
        }
        $this->productStrategy->make($_GET['fillings']);
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->productStrategy = $strategy;
    }
}