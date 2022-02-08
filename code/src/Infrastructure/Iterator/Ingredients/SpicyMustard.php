<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class SpicyMustard extends AbstractFastFoodIngredients
{
    private string $ingredient = 'острая горчица';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}