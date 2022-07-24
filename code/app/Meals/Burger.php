<?php

namespace App\Meal;

class Burger extends MealBaseClass
{
    public function __constructor(): void
    {
        parent::__constructor();
        $this->setIngredients([
            new Ingredient('bread'),
            new Ingredient('cutlet',2),
            new Ingredient('cheese',3),
            new Ingredient('lettuce leaf'),
            new Ingredient('tomato slice'),
            new Ingredient('sauce'),
            new Ingredient('cucumber slice'),
        ]);
    }

}