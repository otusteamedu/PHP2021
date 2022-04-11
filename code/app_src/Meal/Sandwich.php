<?php

namespace App\Meal;

class Sandwich extends MealBaseClass
{
	public function __construct()
	{
		parent::__construct();
		$this->setIngredients([
			new Ingredient('toast', 2),
		]);
	}
}
