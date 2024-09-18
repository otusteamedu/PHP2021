<?php

namespace App\Decorator;

class HotdogDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;

    private static array $baseRecipe = ['ketchup' => 1, 'mustard' => 1, 'sausage' => 1];

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

        $this->mealDecorator->setStatus('Добавлены базовые ингридиенты хот-дога');
    }
}
