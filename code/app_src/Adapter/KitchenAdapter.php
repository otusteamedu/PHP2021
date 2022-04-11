<?php

namespace App\Adapter;

use App\Meal\MealInterface;

class KitchenAdapter
{
	private KitchenService $kitchenService;

	
	public function __construct(KitchenService $kitchenService)
	{
		$this->kitchenService = $kitchenService;
	}
	
	public function cookMeal(MealInterface $meal): void
	{
		$currentIngredients = $meal->getIngredients();
		$meal->resetIngredients();
		$meal->addIngredients($this->kitchenService->fry($currentIngredients));
		
		if ($this->kitchenService->checkMealQuality($meal)) {
			$meal->setStatus('COOKED_AND_CHECKED');
		} else {
			throw new \Exception('Cooking failed');
		}
	}
	
	public function utilizeMeal(MealInterface $meal): void
	{
		$this->kitchenService->utilize($meal);
	}
}