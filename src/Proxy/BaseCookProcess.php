<?php

namespace App\Proxy;

use App\Food\FoodInterface;

class BaseCookProcess implements CookProcessInterface
{
    public function cookFood(FoodInterface $food): void
    {
        $food->cook();
    }
}
