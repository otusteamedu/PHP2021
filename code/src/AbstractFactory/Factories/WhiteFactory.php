<?php

namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Interface\Products;
use App\AbstractFactory\Interface\Burger;
use App\AbstractFactory\Interface\Sandwich;

use App\AbstractFactory\Product\WhiteBurger;
use App\AbstractFactory\Product\WhiteSandwich;

class WhiteFactory implements Products
{

    public function CreateBurger(int $standard): Burger
    {
        return new WhiteBurger($standard);
    }

    public function CreateSandwich(int $standard): Sandwich
    {
        return new WhiteSandwich($standard);
    }
}

