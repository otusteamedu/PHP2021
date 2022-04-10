<?php

namespace App\Factory;

use App\Meal\Burger;
use App\Meal\MealInterface;

class BurgerFactory extends MealFactory
{
	public function createMealBase(): MealInterface
	{
		return new Burger();
	}
}
