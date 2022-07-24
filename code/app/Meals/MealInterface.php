<?php

namespace App\Meal;

interface MealInterface
{
    /**
     * @return array
     */
    public function getIngredients(): array;
}