<?php

namespace App\Factory;

use App\Meal\MealInterface;
use App\Meal\Sandwich;

class SandwichFactory extends MealFactory
{
    public function createMealBase(): MealInterface
    {
        return new Sandwich();
    }
}