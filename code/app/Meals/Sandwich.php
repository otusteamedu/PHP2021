<?php

namespace App\Meal;

class Sandwich extends MealBaseClass
{
    public function __constructor(): void
    {
        parent::__constructor();
        $this->setIngredients([
            new Ingredient('bread'),
            new Ingredient('sauce'),
            new Ingredient('sausage slices',20),
            new Ingredient('cheese'),
        ]);
    }
}