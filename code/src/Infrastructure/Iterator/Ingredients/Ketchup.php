<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class Ketchup extends AbstractFastFoodIngredients
{
    protected string $ingredient = 'кетчуп';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}