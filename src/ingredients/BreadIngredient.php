<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:26
 */

namespace app\ingredients;

/**
 * Ингредиент
 *
 * Class BreadIngredient
 * @package app\ingredients
 */
class BreadIngredient implements IngredientInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Булка";
    }
}
