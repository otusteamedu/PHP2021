<?php

namespace App\Meal;

class Ingredient
{
	private string $name;
	
	private int $amount;
	
	public function __construct(string $name, int $amount)
	{
		$this->name = $name;
		$this->amount = $amount;
	}
	
	public function getName(): string
	{
		return $this->name;
	}
	
	public function getAmount(): int
	{
		return $this->$amount;
	}
}