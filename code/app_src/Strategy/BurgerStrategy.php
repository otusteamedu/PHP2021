<?php

namespace App\Strategy;

use App\Decorator\BurgerDecorator;
use App\Decorator\CustomerIngredientsDecorator;
use App\Decorator\MealDecorator;
use App\Factory\BurgerFactory;
use App\Meal\MealInterface;
use App\Observer\Customer;

class BurgerStrategy implements CookingStrategyInterface
{
    public function prepareIngredients(array $customerIngredients, Customer $customer): MealInterface
    {
        $baseBurger = $this->generateBaseBurger();

        $baseBurger->attach($customer);
        $baseBurger->setStatus('Начало приготовления');

        return $this->addIngredients($baseBurger, $customerIngredients);
    }

    private function generateBaseBurger(): MealInterface
    {
        $factory = new BurgerFactory();

        return $factory->createMealBase();
    }

    private function addIngredients(MealInterface $baseBurger, array $customerIngredients): MealInterface
    {
        $decorator = new MealDecorator($baseBurger);
        $burgerDecorator = new BurgerDecorator($decorator);
        $customerDecorator = new CustomerIngredientsDecorator($decorator);

        $burgerDecorator->addBaseIngredients();
        $customerDecorator->addCustomerIngredients($customerIngredients);

        return $decorator;
    }
}
