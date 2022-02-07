<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class Tomato extends AbstractFastFoodIngredients
{
    private string $ingredient = 'томат';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}