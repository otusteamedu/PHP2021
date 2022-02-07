<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;


class Mayonnaise extends AbstractFastFoodIngredients
{
    private string $ingredient = 'майонез';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}