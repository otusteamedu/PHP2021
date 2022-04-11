<?php

namespace App\Meal;

use SplSubject;
use SplObjectStorage;
use SplObserver;

class MealBaseClass implements MealInterface, SplSubject
{
	private array $ingredients;
	private string $status;

	private SplObjectStorage $observers;

	public function __construct()
	{
		$this->observers = new SplObjectStorage();
	}

	public function attach(SplObserver $observer): void
	{
		$this->observers->attach($observer);
	}

	public function detach(SplObserver $observer): void
	{
		$this->observers->detach($observer);
	}

	public function setStatus(string $status): void
	{
		$this->status = $status;
		$this->notify();
	}
	
	public function getStatus(): string
	{
		return $this->status;
	}

	public function notify(): void
	{
		foreach ($this->observers as $observer) {
			$observer->update($this);
		}
	}
	
	public function getIngredients(): array
	{
		return $this->ingredients;
	}
	
	public function setIngredients(array $ingredients = []): void
	{
		$this->ingredients = $ingredients;
	}
	
	public function addIngredients(array $ingredients = []): void
	{
		$this->ingredients = array_merge($this->ingredients, $ingredients);
	}
}
