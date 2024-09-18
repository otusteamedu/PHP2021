<?php

namespace App\Strategy;

use App\Decorator\CustomerIngredientsDecorator;
use App\Decorator\MealDecorator;
use App\Decorator\SandwichDecorator;
use App\Factory\SandwichFactory;
use App\Meal\MealInterface;
use App\Observer\Customer;

class SandwichStrategy implements CookingStrategyInterface
{
    public function prepareIngredients(array $customerIngredients, Customer $customer): MealInterface
    {
        $baseSandwich = $this->generateBaseSandwich();

        $baseSandwich->attach($customer);
        $baseSandwich->setStatus('Начало приготовления');

        return $this->addIngredients($baseSandwich, $customerIngredients);
    }

    private function generateBaseSandwich(): MealInterface
    {
        $factory = new SandwichFactory();

        return $factory->createMealBase();
    }

    private function addIngredients(MealInterface $baseSandwich, array $customerIngredients): MealInterface
    {
        $decorator = new MealDecorator($baseSandwich);
        $SandwichDecorator = new SandwichDecorator($decorator);
        $customerDecorator = new CustomerIngredientsDecorator($decorator);

        $SandwichDecorator->addBaseIngredients();
        $customerDecorator->addCustomerIngredients($customerIngredients);

        return $decorator;
    }
}
