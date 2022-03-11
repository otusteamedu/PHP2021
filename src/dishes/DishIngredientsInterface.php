<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.03.2022
 * Time: 20:38
 */

namespace app\dishes;

/**
 * Ингредиенты блюда
 *
 * Class DishIngredientsInterface
 * @package app\dishes
 */
interface DishIngredientsInterface
{
    /**
     * Список ингредиентов
     *
     * @return array
     */
    public function getIngredients(): array;
}