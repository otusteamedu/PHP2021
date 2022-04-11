<?php

namespace App\Strategy;

use App\Factory\BurgerFactory;
use App\Meal\MealInterface;
use App\Decorator;
use App\Observer\Customer;

class BurgerStrategy implements CookingStrategyInterface
{
	public function prepareIngredients(array $customerIngredients = [], Customer $customer): MealInterface
	{
		$baseBurger = $this->generateBaseBurger();
		$baseBurger->attach($customer);
		$baseBurger->setStatus('STARTED');
		return $this->addIngredients($baseBurger, $customerIngredients);
	}
	
	private function generateBaseBurger(): MealInterface
	{
		$factory = new BurgerFactory();
		return $factory->createMealBase();
	}

	private function addIngredients(MealInterface $baseBurger, array $customerIngredients): MealInterface
	{
		$decorator = new Decorator\MealDecorator($baseBurger);
		$burgerDecorator = new Decorator\BurgerDecorator($decorator);
		$burgerDecorator->addBaseIngredients();
		$customerDecorator = new Decorator\CustomerIngredientsDecorator($decorator);
		$customerDecorator->addCustomerIngredients($customerIngredients);
		
		return $decorator;
	}
}
