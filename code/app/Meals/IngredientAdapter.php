<?php

namespace App\Meal;

class IngredientAdapter
{
    /**
     * @param array $ingredients
     * @return array
     */
    public function addIngredients(array $ingredients): array
    {
        $arrObjectIngredients = [];
        foreach ($ingredients as $ingredient => $amount)
        {
            $arrObjectIngredients[] = new Ingredient($ingredient, (int) $amount);
        }

        return $arrObjectIngredients;
    }
}