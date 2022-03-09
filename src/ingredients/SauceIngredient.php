<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:27
 */

namespace app\ingredients;

/**
 * Ингредиент
 *
 * Class SauceIngredient
 * @package app\ingredients
 */
class SauceIngredient implements IngredientInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Соус";
    }
}
