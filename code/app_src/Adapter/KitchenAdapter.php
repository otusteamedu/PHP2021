<?php

namespace App\Adapter;

use App\Meal\MealInterface;

class KitchenAdapter
{
    private KitchenService $kitchenService;

    public function __construct(KitchenService $kitchenService)
    {
        $this->kitchenService = $kitchenService;
    }

    public function cookMeal(MealInterface $meal): void
    {
        if ($this->kitchenService->checkMealQuality($meal)) {
            $meal->setStatus('Подготовка ингридиентов');
        } else {
            throw new \Exception('Приготовление блюда невозможно');
        }
    }

    public function utilizeMeal(MealInterface $meal): void
    {
        $this->kitchenService->utilize($meal);
    }
}
