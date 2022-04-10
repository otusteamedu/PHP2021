<?php

namespace App\Adapter;

use App\Meal\MealInterface;

class KitchenService
{
	private static array $needToBeFried = [
		'sausage',
		'cotlete',
		'onion',
		'beef',
	];
	
	public function fry(array $ingredients): array
	{
		$cookedIngredients = [];
		foreach ($ingredients as $ingredient => $value) {
			if (in_array($ingredient, self::$needToBeFried)) {
				$cookedIngredients["fried_$ingredient"] = $value;
			} else {
				$cookedIngredients[$ingredient] = $value;
			}
		}

		return $cookedIngredients;
	}
	
	public function checkMealQuality(MealInterface $meal)
	{
		foreach ($meal->getIngredients() as $ingredient => $value) {
			if (in_array($ingredient, self::$needToBeFried)) {
				return false;
			} 
		}
		
		return true;
	}
	
	public function utilize(MealInterface $meal)
	{
		$meal->setStatus('UTILIZED');
	}
}