<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:29
 */

namespace app\ingredients;

/**
 * Ингредиент
 *
 * Class CheeseIngredient
 * @package app\ingredients
 */
class CheeseIngredient implements IngredientInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Сыыыыр";
    }
}
