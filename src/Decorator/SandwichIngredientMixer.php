<?php

namespace App\Decorator;

use App\Food\Ingredient;

class SandwichIngredientMixer extends RecipeIngredientMixer
{
    public static function get(IngredientMixerInterface $previous
    ): IngredientMixerInterface {
        $mixer = new self($previous);
        $mixer->recipeIngredients = [
            new Ingredient('cheese', 1),
            new Ingredient('lettuce', 1),
        ];

        return $mixer;
    }
}
