<?php
declare(strict_types=1);

namespace App\Infrastructure\Prototype;

class HotDog extends AbstractSandwich
{
    public AbstractSandwich $prototype;

    private array $baseIngredients = ['sausage','sweet mustard','ketchup'];

    public function getNameProduct(): string
    {
        return 'Хот дог';
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