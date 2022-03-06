<?php

namespace App\Decorator;

interface IngredientMixerInterface
{
    public function addIngredients(array $ingredients = []): void;
}
