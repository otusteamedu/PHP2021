<?php

namespace App\Meal;

class Ingredient
{
    private string $name;
    private int $amount;

    /**
     * @param string $name
     * @param int $amount
     */
    public function __construct(string $name, int $amount = 1)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }


}