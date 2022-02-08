<?php
declare(strict_types=1);

namespace App\Infrastructure\Prototype;

class Sandwich extends AbstractSandwich
{
    public AbstractSandwich $prototype;

    private array $baseIngredients = ['cheese','salad','pickled cucumbers', 'mayonnaise', 'pepperoni'];

    public function getNameProduct(): string
    {
        return 'Сэндвич';
    }

    public function getBaseIngredients(): array
    {
        return $this->baseIngredients;
    }

    public function __clone()
    {
        $this->baseIngredients= [];
    }
}