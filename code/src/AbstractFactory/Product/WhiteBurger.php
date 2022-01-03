<?php

namespace App\AbstractFactory\Product;

use App\AbstractFactory\Interface\Burger;

class WhiteBurger implements Burger
{
    public $cookingStage;

    public function __construct(int $cookingStage){
        $this->cookingStage = $cookingStage;
    }

    public function StructureBurger(): string
    {
        return "Белый бургер";
    }
}