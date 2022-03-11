<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:26
 */

namespace app\dishes\ingredients;

use app\dishes\Dish;

/**
 * Ингредиент
 *
 * Class BreadIngredient
 * @package app\dishes\ingredients
 */
class BreadIngredient extends Dish
{
    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return array_merge(
            parent::getIngredients(), [
                "Булка",
            ]
        );
    }
}
