<?php

namespace App\Meal;

class Hotdog extends MealBaseClass
{
	public function __construct()
	{
		parent::__construct();
		$this->setIngredients([
			'bun' => 1,
		]);
	}
}
