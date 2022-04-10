<?php

namespace App\Factory;

use App\Meal\Sandwich;
use App\Meal\MealInterface;

class SandwichFactory extends MealFactory
{
	public function createMealBase(): MealInterface
	{
		return new Sandwich();
	}
}
