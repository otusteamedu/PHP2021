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

	public function addCustomerIngredients(array $customerIngredients)
	{
		$this->mealDecorator->ingredients = array_merge($this->mealDecorator->ingredients, $customerIngredients);
		$this->mealDecorator->setStatus('ADDED_CLIENT_INGREDIENTS');
	}
}