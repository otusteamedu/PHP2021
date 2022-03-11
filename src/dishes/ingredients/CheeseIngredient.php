<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:29
 */

namespace app\dishes\ingredients;

use app\dishes\Dish;

/**
 * Ингредиент
 *
 * Class CheeseIngredient
 * @package app\dishes\ingredients
 */
class CheeseIngredient extends Dish
{
    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return array_merge(
            parent::getIngredients(), [
                "Сыыыыр",
            ]
        );
    }
}
