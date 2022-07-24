<?php

namespace App\Decorators;

use App\Meal\MealBaseClass;

class CustomerIngredientsDecorator extends MealDecorator
{
    private MealDecorator $mealDecorator;

    /**
     * @param MealBaseClass $mealBaseClass
     * @return void
     */
    public function __constructor(MealBaseClass $mealBaseClass): void
    {
        $this->mealDecorator = $mealBaseClass;
    }

    /**
     * @param array $customerIngredients
     * @return void
     */
    public function addCustomerIngredients(array $customerIngredients): void
    {
        $this->mealDecorator->ingredients = array_merge(
            $this->mealDecorator->ingredients,
            $this->mealDecorator->getAdapter()->addIngredients($customerIngredients)
        );
        $this->mealDecorator->setStatus('Added client Ingredients');
    }


}