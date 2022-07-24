<?php

namespace App\Decorators;

use App\Meal\IngredientAdapter;
use App\Meal\MealBaseClass;
use SplObjectStorage;

class MealDecorator extends MealBaseClass
{
    private MealBaseClass $mealBaseClass;
    private SplObjectStorage $splObjectStorage;
    private IngredientAdapter $adapter;

    /**
     * @param MealBaseClass $mealBaseClass
     * @return void
     */
    public function __constructor(MealBaseClass $mealBaseClass): void
    {
        parent::__constructor();
        $this->mealBaseClass = $mealBaseClass;
        $this->adapter = new IngredientAdapter();
        $this->resetIngredients();
    }

    /**
     * @return void
     */
    public function resetIngredients(): void
    {
        $this->ingredients = $this->mealBaseClass->getIngredients();
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->mealBaseClass->setStatus($status);
    }

    /**
     * @return string
     */
    public function getBaseType(): string
    {
        return get_class($this->mealBaseClass);
    }

    /**
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     * @return void
     */
    public function addIngredients(array $ingredients = []): void
    {
        $this->ingredients = array_merge($this->ingredients, $ingredients);
    }

    /**
     * @return IngredientAdapter
     */
    public function getAdapter(): IngredientAdapter
    {
        return $this->adapter;
    }
}