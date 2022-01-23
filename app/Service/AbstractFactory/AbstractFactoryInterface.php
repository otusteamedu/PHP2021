<?php

namespace App\Service\AbstractFactory;

interface AbstractFactoryInterface
{
    public function createBurger(): BurgerInterface;

    public function createSandwich(): SandwichInterface;

    public function createHotDog(): HotDogInterface;
}
