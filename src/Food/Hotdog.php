<?php

namespace App\Food;

class Hotdog extends BaseFood
{
    public function __clone()
    {
        $this->ingredients = [
            new Ingredient('bun', 1),
            new Ingredient('sausage', 1),
        ];
        $this->status = FoodInterface::STATUS_RAW;
    }
}
