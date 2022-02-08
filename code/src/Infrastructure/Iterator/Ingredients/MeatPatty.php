<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class MeatPatty extends AbstractFastFoodIngredients
{

    private string $ingredient = 'мясная котлета';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}