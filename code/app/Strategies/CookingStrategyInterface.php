<?php

namespace App\Strategy;

use App\Meal\MealInterface;
use App\Observer\Customer;

interface CookingStrategyInterface
{
    /**
     * @param array $ingredients
     * @param Customer $customer
     * @return MealInterface
     */
    public function prepareIngredients(array $ingredients, Customer $customer): MealInterface;
}