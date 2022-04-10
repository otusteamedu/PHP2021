<?php

namespace App\Decorator;

use App\Meal\MealBaseClass;

class MealDecorator extends MealBaseClass
{
	
	private MealBaseClass $meal;
	private SplObjectStorage $observers;
	
	public function __construct(MealBaseClass $baseMeal)
	{
		$this->meal = $baseMeal;
		$this->resetIngredients();
	}

	public function resetIngredients(): void
	{
		$this->ingredients = $this->meal->getIngredients();
	}
	
	public function setStatus(string $status): void
	{
		$this->meal->setStatus($status);
	}
	
	public function getBaseMealType(): string
	{
		return get_class($this->meal);
	}
	
	public function getIngredients(): array
	{
		return $this->ingredients;
	}
	
	public function addIngredients(array $ingredients = []): void
	{
		$this->ingredients = array_merge($this->ingredients, $ingredients);
	}

}