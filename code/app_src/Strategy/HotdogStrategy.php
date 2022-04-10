<?php

namespace App\Strategy;

use App\Factory\HotdogFactory;
use App\Meal\MealInterface;
use App\Decorator;
use App\Observer\Customer;

class HotdogStrategy implements CookingStrategyInterface
{
	public function prepareIngredients(array $customerIngredients = [], Customer $customer): MealInterface
	{
		$baseHotdog = $this->generateBaseHotdog();
		$baseHotdog->attach($customer);
		$baseHotdog->setStatus('STARTED');
		return $this->addIngredients($baseHotdog, $customerIngredients);
	}

	private function generateBaseHotdog(): MealInterface
	{
		$factory = new HotdogFactory();
		return $factory->createMealBase();
	}

	private function addIngredients(MealInterface $baseHotdog, array $customerIngredients): MealInterface
	{
		$decorator = new Decorator\MealDecorator($baseHotdog);
		$HotdogDecorator = new Decorator\HotdogDecorator($decorator);
		$HotdogDecorator->addBaseIngredients();
		$customerDecorator = new Decorator\CustomerIngredientsDecorator($decorator);
		$customerDecorator->addCustomerIngredients($customerIngredients);

		return $decorator;
	}
}
