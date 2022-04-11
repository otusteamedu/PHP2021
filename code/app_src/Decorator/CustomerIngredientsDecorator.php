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
		$this->mealDecorator->ingredients = array_merge(
			$this->mealDecorator->ingredients, 
			$this->mealDecorator->getAdapter()->createIngredientsArray($customerIngredients)
		);
		$this->mealDecorator->setStatus('ADDED_CLIENT_INGREDIENTS');
	}
}