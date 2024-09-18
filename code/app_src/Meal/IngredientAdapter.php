<?php

namespace App\Meal;

class IngredientAdapter
{
    public function createIngredientsArray(array $customerIngredients, $custom = false): array
    {
        $ingredients = [];

        foreach ($customerIngredients as $ingredient => $amount) {
            $ingredients[] = new Ingredient($ingredient, (int)$amount, $custom);
        }

        return $ingredients;
    }
}
