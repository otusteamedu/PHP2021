<?php

namespace App\Decorator;

use App\AbstractFactory\Interface\Sandwich;

class SandwichDecorator implements Sandwich
{

    protected $sandwich;

    public function __construct(Sandwich $sandwich)
    {
        $this->sandwich = $sandwich;
    }

    public function StructureSandwich(): string
    {
        return $this->sandwich->StructureSandwich();
    }
}