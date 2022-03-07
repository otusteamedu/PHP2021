<?php

namespace App\Decorator;

use App\Food\Ingredient;

class CustomerIngredientMixer extends IngredientMixer
{
    public static function get(IngredientMixerInterface $food
    ): IngredientMixerInterface {
        return new self($food);
    }

    /**
     * @param Ingredient[] $ingredients
     *
     * @return void
     */
    public function addIngredients(array $ingredients = []): void
    {
        parent::addIngredients($ingredients);
    }
}
