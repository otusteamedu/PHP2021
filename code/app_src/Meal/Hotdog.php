<?php

namespace App\Meal;

class Hotdog extends MealBaseClass
{
	public function __construct()
	{
		parent::__construct();
		$this->setIngredients([
			new Ingredient('bun', 1),
		]);
	}
}
