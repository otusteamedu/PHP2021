<?php

namespace App\Decorator;

use App\Food\Ingredient;

interface IngredientMixerInterface
{
    /**
     * @param Ingredient[] $ingredients
     *
     * @return void
     */
    public function addIngredients(array $ingredients = []): void;
}
