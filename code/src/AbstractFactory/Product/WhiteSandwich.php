<?php

namespace App\AbstractFactory\Product;

use App\AbstractFactory\Interface\Sandwich;

class WhiteSandwich implements Sandwich
{
    public $cookingStage;

    public function __construct(int $cookingStage){
        $this->cookingStage = $cookingStage;
    }

    public function StructureSandwich(): string
    {
        return "Белый сэндвич";
    }
}