<?php

namespace App\Strategy;

use App\Adapters\KitchenAdapter;
use App\Adapters\KitchenService;
use App\Meal\MealInterface;
use App\Observer\Customer;
use Exception;

class OrderContext
{
    private CookingStrategyInterface $strategy;
    private Customer $customer;

    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param CookingStrategyInterface $strategy
     * @return void
     */
    public function setCookingStrategy(CookingStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @param array $ingredients
     * @return MealInterface
     */
    public function getOrderedMeal(array $ingredients = []): MealInterface
    {
        $orderedMeal = $this->strategy->prepareIngredients($ingredients, $this->customer);
        $orderedMeal->setStatud('Preparations');

        try {
            $kitchen = new KitchenAdapter(new KitchenService());
            $kitchen->cookMeal($orderedMeal);
        } catch (Exception $e) {
            if ($kitchen instanceof KitchenAdapter) {
                $kitchen->utilizeMeal($orderedMeal);
            }
        }

        return $orderedMeal;
    }
}