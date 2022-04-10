<?php

namespace App\Factory;

use App\Meal\MealInterface;

abstract class MealFactory
{	

	abstract public function createMealBase(): MealInterface;
	
}