<?php

namespace App\Decorator;

use App\Food\Ingredient;

class IngredientMixer implements IngredientMixerInterface
{
    protected IngredientMixerInterface $food;

    public function __construct(IngredientMixerInterface $food)
    {
        $this->food = $food;
    }

    /**
     * @param Ingredient[] $ingredients
     *
     * @return void
     */
    public function addIngredients(array $ingredients = []): void
    {
        $this->food->addIngredients($ingredients);
    }
}
