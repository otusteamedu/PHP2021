<?php

namespace App\Meal;

class IngredientAdapter
{	
	public function createIngredientsArray(array $customerIngredients): array
	{
		$ingredients = [];
		foreach ($customerIngredients as $ingredient => $amount) {
			$ingredients[] = new Ingredient($ingredient, (int)$amount);
		}
		
		return $ingredients;
	}
}