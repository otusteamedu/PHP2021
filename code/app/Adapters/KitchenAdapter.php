<?php

namespace App\Adapters;

use App\Meal\MealInterface;
use Exception;

class KitchenAdapter
{
    private KitchenService $kitchenService;

    /**
     * @param KitchenService $kitchenService
     */
    public function __construct(KitchenService $kitchenService)
    {
        $this->kitchenService = $kitchenService;
    }

    /**
     * @param MealInterface $meal
     * @return void
     * @throws Exception
     */
    public function cookMeal(MealInterface $meal): void
    {
        $currentIngredients = $meal->getIngredients();
        $meal->resetIngredients();
        $meal->addIngredients($this->kitchenService->fry($currentIngredients));

        if ($this->kitchenService->checkMealQuality($meal)) {
            $meal->setStatus('Cooked and checked');
        } else {
            throw new Exception('Cooking failed');
        }
    }

    /**
     * @param MealInterface $meal
     * @return void
     */
    public function utilizeMeal(MealInterface $meal): void
    {
        $this->kitchenService->utilize($meal);
    }
}