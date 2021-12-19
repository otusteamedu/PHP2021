<?php

namespace App\AbstractFactory\Product;

use App\AbstractFactory\Interface\Sandwich;

class WhiteSandwich implements Sandwich
{
    public $standard;

    public function __construct(int $standard){
        $this->standard = $standard;
    }

    public function StructureSandwich(): string
    {
        return "Белый сэндвич";
    }
}