<?php

namespace App\Strategy;

use App\Factory\SandwichFactory;
use App\Meal\MealInterface;
use App\Decorator;
use App\Observer\Customer;

class SandwichStrategy implements CookingStrategyInterface
{
	public function prepareIngredients(array $customerIngredients = [], Customer $customer): MealInterface
	{
		$baseSandwich = $this->generateBaseSandwich();
		$baseSandwich->attach($customer);
		$baseSandwich->setStatus('STARTED');
		return $this->addIngredients($baseSandwich, $customerIngredients);
	}

	private function generateBaseSandwich(): MealInterface
	{
		$factory = new SandwichFactory();
		return $factory->createMealBase();
	}

	private function addIngredients(MealInterface $baseSandwich, array $customerIngredients): MealInterface
	{
		$decorator = new Decorator\MealDecorator($baseSandwich);
		$SandwichDecorator = new Decorator\SandwichDecorator($decorator);
		$SandwichDecorator->addBaseIngredients();
		$customerDecorator = new Decorator\CustomerIngredientsDecorator($decorator);
		$customerDecorator->addCustomerIngredients($customerIngredients);

		return $decorator;
	}
}
