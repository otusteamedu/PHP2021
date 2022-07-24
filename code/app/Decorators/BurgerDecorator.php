<?php

namespace App\Decorators;


class BurgerDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;
    private static array $baseRecipe = [
        'pickles' => 3,
        'onion' => 2,
        'lettuce' => 1,
        'cotlete' => 1,
    ];

    /**
     * @param MealDecorator $mealBaseClass
     * @return void
     */
    public function __constructor(MealDecorator $mealBaseClass): void
    {
        $this->mealDecorator = $mealBaseClass;
    }

    /**
     * @return void
     */
    public function addBaseIngredients(): void
    {
        $this->mealDecorator->ingredients = array_merge(
            $this->mealDecorator->ingredients,
            $this->mealDecorator->getAdapter()->addIngredients(self::$baseRecipe)
        );
        $this->mealDecorator->setStatus('Added base burger recipe ingredients');
    }
}