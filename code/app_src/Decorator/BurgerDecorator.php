<?php

namespace App\Decorator;

class BurgerDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;

    private static array $baseRecipe = ['pickles' => 3, 'onion' => 2, 'lettuce' => 1, 'cutlet' => 1];

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

        $this->mealDecorator->setStatus('Добавление базовых ингридиентов бургера');
    }
}
