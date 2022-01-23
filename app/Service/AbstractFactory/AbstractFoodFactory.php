<?php

namespace App\Service\AbstractFactory;

class AbstractFoodFactory implements AbstractFactoryInterface
{

    public function createBurger(): BurgerInterface
    {
        return new Burger();
    }

    public function createSandwich(): SandwichInterface
    {
        return new Sandwich();
    }

    public function createHotDog(): HotDogInterface
    {
        return new HotDog();
    }
}
