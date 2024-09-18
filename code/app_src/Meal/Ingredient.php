<?php

namespace App\Meal;

class Ingredient
{
    public readonly string $name;
    public readonly int $amount;
    public readonly bool $custom;

    public function __construct(string $name, int $amount, $custom = false)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->custom = $custom;
    }
}
