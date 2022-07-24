<?php

namespace App\Strategy;

use App\Decorators\CustomerIngredientsDecorator;
use App\Decorators\MealDecorator;
use App\Decorators\SandwichDecorator;
use App\Factory\SandwichFactory;
use App\Meal\MealInterface;
use App\Observer\Customer;

class SandwichStrategy implements CookingStrategyInterface
{

    public function prepareIngredients(array $ingredients, Customer $customer): MealInterface
    {
        $baseSandwich = $this->generateBaseSandwich();
        $baseSandwich->attach($customer);
        $baseSandwich->setStatus('Started');
        return $this->addIngredients($baseSandwich, $ingredients);

    }

    /**
     * @return MealInterface
     */
    private function generateBaseSandwich(): MealInterface
    {
        return (new SandwichFactory())->createMealBase();
    }

    /**
     * @param MealInterface $meal
     * @param array $customerIngredients
     * @return MealInterface
     */
    private function addIngredients(MealInterface $meal, array $customerIngredients): MealInterface
    {
        $decorator = new MealDecorator($meal);
        $sandwichDecorator = new SandwichDecorator($decorator);
        $sandwichDecorator->addBaseIngredients();
        $customerDecorator = new CustomerIngredientsDecorator($decorator);
        $customerDecorator->addCustomerIngredients($customerIngredients);

        return $decorator;
    }
}