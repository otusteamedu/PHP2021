<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;


class Cheese extends AbstractFastFoodIngredients
{
    private string $ingredient = 'сыр';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}