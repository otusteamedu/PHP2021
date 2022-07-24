<?php

namespace App\Factory;

use App\Meal\HotDog;
use App\Meal\MealInterface;

class HotDogFactory extends MealFactory
{
    public function createMealBase(): MealInterface
    {
        return new HotDog();
    }
}