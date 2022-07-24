<?php

namespace App\Strategy;

use App\Decorators\CustomerIngredientsDecorator;
use App\Decorators\HotDogDecorator;
use App\Decorators\MealDecorator;
use App\Factory\HotDogFactory;
use App\Meal\MealInterface;
use App\Observer\Customer;

class HotDogStrategy implements CookingStrategyInterface
{
    /**
     * @param array $ingredients
     * @param Customer $customer
     * @return MealInterface
     */
    public function prepareIngredients(array $ingredients, Customer $customer): MealInterface
    {
        $baseHotDog = $this->generateBaseHotDog();
        $baseHotDog->attach($customer);
        $baseHotDog->setStatus('Started');
        return $this->addIngredients($baseHotDog, $ingredients);
    }

    /**
     * @return MealInterface
     */
    private function generateBaseHotDog(): MealInterface
    {
        return (new HotDogFactory())->createMealBase();
    }

    /**
     * @param MealInterface $meal
     * @param array $customerIngredients
     * @return MealInterface
     */
    private function addIngredients(MealInterface $meal, array $customerIngredients): MealInterface
    {
        $decorator = new MealDecorator($meal);
        $hotDogDecorator = new HotDogDecorator($decorator);
        $hotDogDecorator->addBaseIngredients();
        $customerDecorator = new CustomerIngredientsDecorator($decorator);
        $customerDecorator->addCustomerIngredients($customerIngredients);

        return $decorator;
    }
}