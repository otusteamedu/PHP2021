<?php

namespace App\Adapters;

use App\Meal\MealInterface;

class KitchenService
{
    private static array $needFried = [
        'bread',
        'cutlet',
        'sausage',
        'sausage slices',
        'onion',
        'beef',
    ];

    /**
     * @param array $ingredients
     * @return array
     */
    public function fry(array $ingredients): array
    {
        $cookedIngredients = [];
        foreach ($ingredients as $ingredient => $value) {
            if (in_array($ingredient, self::$needFried)) {
                $cookedIngredients["fried_{$ingredient}"] = $value;
            } else {
                $cookedIngredients[$ingredient] = $value;
            }
        }

        return $cookedIngredients;
    }

    /**
     * @param MealInterface $meal
     * @return bool
     */
    public function checkMealQuality(MealInterface $meal): bool
    {
        foreach ($meal->getIngredients() as $ingredient => $value)
            if (in_array($ingredient, self::$needFried)) return false;
        return true;
    }

    /**
     * @param MealInterface $meal
     * @return void
     */
    public function utilize(MealInterface $meal): void
    {
        $meal->setStatus('Utilized');
    }
}