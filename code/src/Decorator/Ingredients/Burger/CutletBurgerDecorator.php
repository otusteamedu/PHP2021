<?php

namespace App\Decorator\Ingredients\Burger;

use App\Decorator\BurgerDecorator;

class CutletBurgerDecorator extends BurgerDecorator
{
    public function StructureBurger(): string
    {
        return parent::StructureBurger() . " + Котлета";
    }
}