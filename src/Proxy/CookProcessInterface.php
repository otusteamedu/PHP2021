<?php

namespace App\Proxy;

use App\Food\FoodInterface;

interface CookProcessInterface
{
    public function cookFood(FoodInterface $food): void;
}
