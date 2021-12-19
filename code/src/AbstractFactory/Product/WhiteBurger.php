<?php

namespace App\AbstractFactory\Product;

use App\AbstractFactory\Interface\Burger;

class WhiteBurger implements Burger
{
    public $standard;

    public function __construct(int $standard){
        $this->standard = $standard;
    }

    public function StructureBurger(): string
    {
        return "Белый бургер";
    }
}