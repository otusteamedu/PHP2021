<?php

namespace App\Strategy;

use App\AbstractFactory\Factories\WhiteFactory;
use App\Proxy\BurgerProxy;
use App\Decorator\Ingredients\Burger\SalatBurgerDecorator;
use App\Decorator\Ingredients\Burger\CutletBurgerDecorator;
use App\Decorator\Ingredients\Burger\СheeseBurgerDecorator;
use App\Strategy\Interface\Strategy;

class WhiteFactoryBurger implements Strategy
{

    public function execute(int $standard): string
    {
        $whiteFactory = new WhiteFactory;
        $whiteBurger = $whiteFactory->CreateBurger($standard);

        $whiteBurger = new BurgerProxy($whiteBurger);

        $whiteBurger = new SalatBurgerDecorator($whiteBurger);
        $whiteBurger = new CutletBurgerDecorator($whiteBurger);
        $whiteBurger = new СheeseBurgerDecorator($whiteBurger);

        $whiteBurger = $whiteBurger->StructureBurger();
        
        return $whiteBurger;
        
    }

}