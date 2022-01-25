<?php

namespace App\Decorator\Ingredients\Sandwich;

use App\Decorator\SandwichDecorator;

class СheeseSandwichDecorator extends SandwichDecorator
{
    public function StructureSandwich(): string
    {
        return parent::StructureSandwich() . " + Сыр";
    }
}

