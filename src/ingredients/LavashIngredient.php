<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:30
 */

namespace app\ingredients;

/**
 * Ингредиент
 *
 * Class LavashIngredient
 * @package app\ingredients
 */
class LavashIngredient implements IngredientInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Лаваш";
    }
}
