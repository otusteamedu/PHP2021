<?php

namespace App\Meal;

class HotDog extends MealBaseClass
{
    public function __constructor(): void
    {
        parent::__constructor();
        $this->setIngredients([
            new Ingredient('bread'),
            new Ingredient('sausage'),
            new Ingredient('sauce'),
            new Ingredient('carrot')
        ]);
    }
}