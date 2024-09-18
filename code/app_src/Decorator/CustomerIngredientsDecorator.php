<?php

namespace App\Decorator;

use App\Meal\MealInterface;

class CustomerIngredientsDecorator extends MealDecorator
{
	private MealDecorator $mealDecorator;
	public function __construct(MealDecorator $mealDecorator)
	{
		$this->mealDecorator = $mealDecorator;
	}

	public function addCustomerIngredients(array $customerIngredients): void
	{
        $preparedCustomIngredient = $this->preparedCustomIngredients($customerIngredients);
		$this->mealDecorator->ingredients = array_merge(
			$this->mealDecorator->ingredients, 
			$this->mealDecorator->getAdapter()->createIngredientsArray($preparedCustomIngredient, true)
		);

		$this->mealDecorator->setStatus('Приготовка дополнительного блюда');
	}

    private function preparedCustomIngredients($customerIngredients) : array {
        foreach ($customerIngredients as $ingredient) {
            $preparedCustomIngredients[$ingredient] = 1;
        }

        return $preparedCustomIngredients;
    }
}
