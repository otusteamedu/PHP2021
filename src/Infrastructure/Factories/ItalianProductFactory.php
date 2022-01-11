<?php

namespace App\Infrastructure\Factories;

use App\Application\ProductFactoryInterface;
use App\Domain\Models\BaseProduct;
use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Italian\ItalianBurger;
use App\Domain\Models\Italian\ItalianHotDog;
use App\Domain\Models\Italian\ItalianSandwich;
use App\Domain\Models\Sandwich;

class ItalianProductFactory implements ProductFactoryInterface
{


    public function __construct()
    {
        $this->baseBurger = new ItalianBurger();
        $this->baseHotDog = new ItalianHotDog();
        $this->baseSandwich = new ItalianSandwich();
    }

    public function createBurger(): BaseProduct
    {
        return $this->baseBurger->clone();
    }

    public function createSandwich(): BaseProduct
    {
        return $this->baseSandwich->clone();
    }

    public function createHotDog(): BaseProduct
    {
        return $this->baseHotDog->clone();
    }
}