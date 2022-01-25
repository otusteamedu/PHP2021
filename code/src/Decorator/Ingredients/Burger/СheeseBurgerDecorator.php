<?php

namespace App\Decorator\Ingredients\Burger;

use App\Decorator\BurgerDecorator;

class СheeseBurgerDecorator extends BurgerDecorator
{
    public function StructureBurger(): string
    {
        return parent::StructureBurger() . " + Сыр";
    }
}

