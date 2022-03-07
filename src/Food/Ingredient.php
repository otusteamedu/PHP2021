<?php

namespace App\Food;

class Ingredient
{
    protected string $name = '';
    protected int $quantity = 0;

    public function __construct(string $name, int $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function __toString(): string
    {
        return sprintf('%s - %s', $this->name, $this->quantity);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
