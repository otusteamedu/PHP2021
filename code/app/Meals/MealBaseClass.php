<?php

namespace App\Meal;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class MealBaseClass implements MealInterface, SplSubject
{
    public array $ingredients;
    private string $status;
    private SplObjectStorage $objectStorage;

    /**
     * @return void
     */
    public function __constructor(): void
    {
        $this->objectStorage = new SplObjectStorage();
    }

    /**
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @param SplObserver $observer
     * @return void
     */
    public function attach(SplObserver $observer): void
    {
        $this->objectStorage->attach($observer);
    }

    /**
     * @param SplObserver $observer
     * @return void
     */
    public function detach(SplObserver $observer): void
    {
        $this->objectStorage->detach($observer);
    }

    /**
     * @return void
     */
    public function notify(): void
    {
        foreach ($this->objectStorage as $item) {
            $item->update($this);
        }
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->notify();
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param array $ingredients
     * @return void
     */
    public function setIngredients(array $ingredients = []): void
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @param array $ingredients
     * @return void
     */
    public function addIngredients(array $ingredients = []): void
    {
        $this->ingredients = array_merge($this->ingredients, $ingredients);
    }

}