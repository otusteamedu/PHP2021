<?php

namespace App\Food;

class Sandwich extends BaseFood
{
    public function __clone()
    {
        $this->ingredients = [new Ingredient('bread', 2)];
        $this->status = FoodInterface::STATUS_RAW;
    }
}
