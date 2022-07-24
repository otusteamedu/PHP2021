<?php

namespace App\Strategy;

use App\Decorators\BurgerDecorator;
use App\Decorators\CustomerIngredientsDecorator;
use App\Decorators\MealDecorator;
use App\Factory\BurgerFactory;
use App\Meal\MealInterface;
use App\Observer\Customer;

class BurgerStrategy implements CookingStrategyInterface
{

    /**
     * @param array $ingredients
     * @param Customer $customer
     * @return MealInterface
     */
    public function prepareIngredients(array $ingredients, Customer $customer): MealInterface
    {
        $baseBurger = $this->generateBaseBurger();
        $baseBurger->attach($customer);
        $baseBurger->setStatus('Started');
        return $this->addIngredients($baseBurger, $ingredients);
    }

    /**
     * @return MealInterface
     */
    private function generateBaseBurger(): MealInterface
    {
        $factory = new BurgerFactory();
        return $factory->createMealBase();
    }

    /**
     * @param MealInterface $meal
     * @param array $customerIngredients
     * @return MealInterface
     */
    private function addIngredients(MealInterface $meal, array $customerIngredients): MealInterface
    {
        $decorator = new MealDecorator($meal);
        $burgerDecorator = new BurgerDecorator($decorator);
        $burgerDecorator->addBaseIngredients();
        $customerDecorator = new CustomerIngredientsDecorator($decorator);
        $customerDecorator->addCustomerIngredients($customerIngredients);

        return $decorator;
    }
}