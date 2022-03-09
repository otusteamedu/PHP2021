<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:47
 */

namespace app\ingredients;


/**
 * Интерфейс ингредиента
 *
 * Class BaseIngredient
 * @package app\ingredients
 */
interface IngredientInterface
{
    /**
     * Название ингредиента
     *
     * @return string
     */
    public static function getTitle(): string;
}
