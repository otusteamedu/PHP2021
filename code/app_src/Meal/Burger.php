<?php

namespace App\Meal;

class Burger extends MealBaseClass
{
	public function __construct()
	{
		parent::__construct();
		$this->setIngredients([
			new Ingredient('bun', 2),
		]);
	}
}
