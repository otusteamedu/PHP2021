<?php

namespace App\Decorators;

use App\Meal\MealBaseClass;

class HotDogDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;
    private static array $baseRecipe = [
        'ketchup' => 1,
        'mustard' => 1,
        'sausage' => 1,
    ];

    /**
     * @param MealBaseClass $mealBaseClass
     * @return void
     */
    public function __constructor(MealBaseClass $mealBaseClass): void
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
        $this->mealDecorator->setStatus('Added base hot-dog recipe ingredients');
    }
}