<?php

namespace App\Decorator;

use App\Food\Ingredient;

class BurgerIngredientMixer extends RecipeIngredientMixer
{
    public static function get(IngredientMixerInterface $food
    ): IngredientMixerInterface {
        $mixer = new self($food);
        $mixer->recipeIngredients = [
            new Ingredient('cheese', 1),
            new Ingredient('cucumber', 1),
            new Ingredient('lettuce', 2),
            new Ingredient('bow', 1),
        ];

        return $mixer;
    }
}
