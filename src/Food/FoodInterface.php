<?php

namespace App\Food;

use App\Decorator\IngredientMixerInterface;
use App\Proxy\CookProcessInterface;

interface FoodInterface extends IngredientMixerInterface, CookProcessInterface
{
}
