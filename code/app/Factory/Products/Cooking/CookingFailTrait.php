<?php

namespace App\Factory\Products\Cooking;

use LogicException;

trait CookingFailTrait
{

    public function throwRecipeException()
    {
        throw new LogicException(
            "Невозможно приготовить блюдо. Проверьте указанный рецепт на соответствие тех. карте."
        );
    }

}