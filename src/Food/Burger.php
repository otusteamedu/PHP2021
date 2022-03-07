<?php

namespace App\Food;

class Burger extends BaseFood
{
    public function __clone()
    {
        $this->ingredients = [
            new Ingredient('bun', 2),
            new Ingredient('beef', 1),
        ];
        $this->status = FoodInterface::STATUS_RAW;
    }
}
