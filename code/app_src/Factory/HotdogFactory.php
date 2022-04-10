<?php

namespace App\Factory;

use App\Meal\Hotdog;
use App\Meal\MealInterface;

class HotdogFactory extends MealFactory
{
	public function createMealBase(): MealInterface
	{
		return new Hotdog();
	}
}
