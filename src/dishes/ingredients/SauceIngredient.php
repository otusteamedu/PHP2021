<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:27
 */

namespace app\dishes\ingredients;

use app\dishes\Dish;

/**
 * Ингредиент
 *
 * Class SauceIngredient
 * @package app\dishes\ingredients
 */
class SauceIngredient extends Dish
{
    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return array_merge(
            parent::getIngredients(), [
                "Соус",
            ]
        );
    }
}
