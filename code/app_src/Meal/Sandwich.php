<?php

namespace App\Meal;

class Sandwich extends MealBaseClass
{
	public function __construct()
	{
		parent::__construct();
		$this->setIngredients([
			'toast' => 2,
		]);
	}
}
