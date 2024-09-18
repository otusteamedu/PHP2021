<?php

namespace App\Decorator;

class SandwichDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;
    private static array $baseRecipe = ['ham' => 1, 'cheese' => 2];

    public function __construct(MealDecorator $mealDecorator)
    {
        $this->mealDecorator = $mealDecorator;
    }

    function addBaseIngredients(): void
    {
        $this->mealDecorator->ingredients = array_merge(
            $this->mealDecorator->ingredients,
            $this->mealDecorator->getAdapter()->createIngredientsArray(self::$baseRecipe)
        );

        $this->mealDecorator->setStatus('Добавлены базовые ингридиенты сендвича');
    }
}