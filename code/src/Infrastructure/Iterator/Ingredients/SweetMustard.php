<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class SweetMustard extends AbstractFastFoodIngredients
{
    private string $ingredient = 'сладкая горчица';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}