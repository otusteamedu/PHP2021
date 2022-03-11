<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:30
 */

namespace app\dishes\ingredients;

use app\dishes\Dish;

/**
 * Ингредиент
 *
 * Class LavashIngredient
 * @package app\dishes\ingredients
 */
class LavashIngredient extends Dish
{
    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return array_merge(
            parent::getIngredients(), [
                "Лаваш",
            ]
        );
    }
}
