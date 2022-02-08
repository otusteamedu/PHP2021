<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;


class Onion extends AbstractFastFoodIngredients
{
    private string $ingredient = 'лук';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}