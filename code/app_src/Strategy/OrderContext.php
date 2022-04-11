<?php

namespace App\Strategy;

use App\Observer\Customer;
use App\Adapter\KitchenAdapter;
use App\Adapter\KitchenService;
use App\Meal\MealInterface;

class OrderContext {
	
    private CookingStrategyInterface $strategy;
	private Customer $customerObserver;
    
	public function __construct(Customer $customer)
    {
		$this->customerObserver = $customer;
    }
	
	public function setCookingStrategy(CookingStrategyInterface $strategy): void
    {
		$this->strategy = $strategy;
    }

	public function getOrderedMeal(array $customerIngredients = []): MealInterface
    {
		$orderedMeal = $this->strategy->prepareIngredients($customerIngredients, $this->customerObserver);
		$orderedMeal->setStatus('INGREDIENTS_PREPARED');
		
		try {
			$kitchen = new KitchenAdapter(new KitchenService());
			$kitchen->cookMeal($orderedMeal);
		} catch (\Exception $e) {
			if ($kitchen instanceof KitchenAdapter) {
				$kitchen->utilizeMeal($orderedMeal);
			}
		}
		
		return $orderedMeal;
    }
}
