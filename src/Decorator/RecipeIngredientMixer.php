<?php

namespace App\Decorator;

use App\Food\Ingredient;

class RecipeIngredientMixer extends IngredientMixer
{
    /**
     * @var Ingredient[]
     */
    protected array $recipeIngredients = [];

    /**
     * @param Ingredient[] $ingredients
     *
     * @return void
     */
    public function addIngredients(array $ingredients = []): void
    {
        parent::addIngredients(array_merge($this->recipeIngredients, $ingredients));
    }
}
