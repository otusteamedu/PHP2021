<?php

namespace App\Decorator;

use App\Food\Ingredient;

class HotdogIngredientMixer extends RecipeIngredientMixer
{
    public static function get(IngredientMixerInterface $previous
    ): IngredientMixerInterface {
        $mixer = new self($previous);
        $mixer->recipeIngredients = [
            new Ingredient('tomato', 1),
            new Ingredient('lettuce', 1),
        ];

        return $mixer;
    }
}
