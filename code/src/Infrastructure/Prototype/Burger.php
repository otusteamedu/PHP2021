<?php
declare(strict_types=1);

namespace App\Infrastructure\Prototype;

class Burger extends AbstractSandwich
{
    public AbstractSandwich $prototype;

    private array $baseIngredients = ['cheese','tomato','onion','meat patty','ketchup','mayonnaise'];

    public function getNameProduct(): string
    {
        return 'Бургер';
    }

    public function getBaseIngredients(): array
    {
        return $this->baseIngredients;
    }

    /**
     * @param array|string[] $ingredients
     */
    public function setBaseIngredients(array $ingredients): void
    {
        $this->baseIngredients = $ingredients;
    }

    public function __clone()
    {
        $this->baseIngredients = [];

    }

}