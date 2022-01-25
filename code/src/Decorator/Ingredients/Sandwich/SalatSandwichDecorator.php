<?php

namespace App\Decorator\Ingredients\Sandwich;

use App\Decorator\SandwichDecorator;

class SalatSandwichDecorator extends SandwichDecorator
{
    public function StructureSandwich(): string
    {
        return parent::StructureSandwich() . " + Салат";
    }
}

