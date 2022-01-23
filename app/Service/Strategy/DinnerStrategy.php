<?php

namespace App\Service\Strategy;

use App\Service\AbstractFactory\AbstractFoodFactory;
use App\Service\Decorator\KetchupTopping;
use App\Service\Decorator\OnionTopping;


class DinnerStrategy implements StrategyInterface
{


    public function execute()
    {
        $factory = new AbstractFoodFactory();
        $food = $factory->createBurger();

        $decorator1= new KetchupTopping($food);
        $decorator2 = new OnionTopping($decorator1);

        return $decorator2;
    }
}
