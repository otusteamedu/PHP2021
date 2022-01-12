<?php


namespace App\Infrastructure\Facades;


use App\App;
use App\Application\Strategies\BurgerStrategy;
use App\Application\Strategies\HotDogStrategy;
use App\Application\Strategies\SandwichStrategy;
use App\Application\Strategies\Strategy;
use App\Domain\Models\BaseProduct;

class KitchenFacade
{
    private $strategies = [];
    private $productStrategy = [];

    public function __construct()
    {
        $this->setStrategies();
    }

    public function makeFood($productType, $fillings) :BaseProduct
    {
        if (!isset($this->strategies[$productType])) throw new \Exception('this type does not exists');
        $this->setStrategy($this->strategies[$productType]());
        return $this->productStrategy->make($fillings);
    }

    private function setStrategies() :void
    {
        $container = App::getInstance()->getContainer();
        $this->strategies = [
            'burger' => function () use ($container) {
                return $container->make(BurgerStrategy::class);
            },
            'hotdog' => function () use ($container) {
                return $container->make(HotDogStrategy::class);
            },
            'sandwich' => function () use ($container) {
                return $container->make(SandwichStrategy::class);
            },
        ];
    }

    private function setStrategy(Strategy $strategy) :void
    {
        $this->productStrategy = $strategy;
    }
}