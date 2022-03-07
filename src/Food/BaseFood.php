<?php

namespace App\Food;

class BaseFood implements FoodInterface
{
    protected int $status;

    /**
     * @var Ingredient[]
     */
    protected array $ingredients;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function cook(): void
    {
        sleep(1);
        $status = rand(1, 10);
        $this->status = FoodInterface::STATUS_DONE;
        if ($status < 5) {
            $this->status = FoodInterface::STATUS_FAIL;
        }
    }

    /**
     * @param Ingredient[] $ingredients
     *
     * @return void
     */
    public function addIngredients(array $ingredients = []): void
    {
        $this->ingredients = array_merge($this->ingredients, $ingredients);
    }

    public function getIngredientsList(): string
    {
        return implode(', ', $this->ingredients);
    }
}
