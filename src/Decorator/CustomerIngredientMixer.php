<?php

namespace App\Decorator;

class CustomerIngredientMixer extends IngredientMixer
{
    public function addIngredients(array $ingredients = []): void
    {
        parent::addIngredients($ingredients);
    }
}
