<?php

namespace App\Decorator;

class IngredientMixer implements IngredientMixerInterface
{
    protected IngredientMixerInterface $food;

    public function __construct(IngredientMixerInterface $food)
    {
        $this->food = $food;
    }

    public function addIngredients(array $ingredients = []): void
    {
        $this->food->addIngredients($ingredients);
    }
}
