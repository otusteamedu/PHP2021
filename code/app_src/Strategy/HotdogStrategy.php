<?php

namespace App\Strategy;

use App\Decorator\CustomerIngredientsDecorator;
use App\Decorator\HotdogDecorator;
use App\Decorator\MealDecorator;
use App\Factory\HotdogFactory;
use App\Meal\MealInterface;
use App\Observer\Customer;

class HotdogStrategy implements CookingStrategyInterface
{
    public function prepareIngredients(array $customerIngredients, Customer $customer): MealInterface
    {
        $baseHotdog = $this->generateBaseHotdog();

        $baseHotdog->attach($customer);
        $baseHotdog->setStatus('Приготовление начато');

        return $this->addIngredients($baseHotdog, $customerIngredients);
    }

    private function generateBaseHotdog(): MealInterface
    {
        $factory = new HotdogFactory();

        return $factory->createMealBase();
    }

    private function addIngredients(MealInterface $baseHotdog, array $customerIngredients): MealInterface
    {
        $decorator = new MealDecorator($baseHotdog);
        $HotdogDecorator = new HotdogDecorator($decorator);
        $customerDecorator = new CustomerIngredientsDecorator($decorator);

        $HotdogDecorator->addBaseIngredients();
        $customerDecorator->addCustomerIngredients($customerIngredients);

        return $decorator;
    }
}
