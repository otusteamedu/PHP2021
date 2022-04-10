<?php

namespace App\Strategy;

use App\Meal\MealInterface;
use App\Observer\Customer;

interface CookingStrategyInterface {
	
	public function prepareIngredients(array $customerIngredients, Customer $customer): MealInterface;

}
