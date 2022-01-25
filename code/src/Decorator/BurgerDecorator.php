<?php

namespace App\Decorator;

use App\AbstractFactory\Interface\Burger;

class BurgerDecorator implements Burger
{

    protected $burger;

    public function __construct(Burger $burger)
    {
        $this->burger = $burger;
    }

    public function StructureBurger(): string
    {
        return $this->burger->StructureBurger();
    }
}