<?php

namespace App\Decorator\Ingredients\Sandwich;

use App\Decorator\SandwichDecorator;

class TunatSandwichDecorator extends SandwichDecorator
{
    public function StructureSandwich(): string
    {
        return parent::StructureSandwich() . " + Тунец";
    }
}