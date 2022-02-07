<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class Pepperoni extends AbstractFastFoodIngredients
{
    private string $ingredient = 'пепперони';

    public function getIngredient():string
    {
        return $this->ingredient;
    }


}