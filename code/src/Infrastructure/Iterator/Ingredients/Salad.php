<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class Salad extends AbstractFastFoodIngredients
{
    private string $ingredient = 'салат';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}