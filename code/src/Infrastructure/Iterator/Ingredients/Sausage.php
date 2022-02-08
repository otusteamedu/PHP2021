<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

class Sausage extends AbstractFastFoodIngredients
{

    private string $ingredient = 'сосиска';

    public function getIngredient():string
    {
        return $this->ingredient;
    }

}