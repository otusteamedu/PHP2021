<?php

namespace App\Meal;

class Burger extends MealBaseClass
{
	public function __construct()
	{
		parent::__construct();
		$this->setIngredients([
			'bun' => 2,
		]);
	}
}
