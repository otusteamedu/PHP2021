<?php

namespace App\Decorator\Ingredients\Burger;

use App\Decorator\BurgerDecorator;

class SalatBurgerDecorator extends BurgerDecorator
{
    public function StructureBurger(): string
    {
        return parent::StructureBurger() . " + Салат";
    }
}

