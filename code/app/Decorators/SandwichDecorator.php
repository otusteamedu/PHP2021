<?php

namespace App\Decorators;

use App\Meal\MealBaseClass;

class SandwichDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;
    private static array $baseRecipe = [
        'ham' => 1,
        'cheese' => 2,
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
        $this->mealDecorator->setStatus('Added base sandwich recipe ingredients');
    }
}