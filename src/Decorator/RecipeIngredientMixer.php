<?php

namespace App\Decorator;

class RecipeIngredientMixer extends IngredientMixer
{
    protected array $recipeIngredients = [];

    public function addIngredients(array $ingredients = []): void
    {
        parent::addIngredients(array_merge($this->recipeIngredients, $ingredients));
    }
}
