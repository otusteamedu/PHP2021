<?php

namespace App\Service\Strategy;


use App\Service\AbstractFactory\AbstractFoodFactory;


class BreakfastStrategy implements StrategyInterface
{


    public function execute()
    {
        $factory = new AbstractFoodFactory();
        $food = $factory->createSandwich();

        return $food;
    }
}
