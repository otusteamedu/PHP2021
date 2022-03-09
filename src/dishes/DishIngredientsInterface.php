<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 11:28
 */

namespace app\dishes;

use app\ingredients\IngredientInterface;

/**
 *
 *
 * Class DishInterface
 * @package app\dishes
 */
interface DishIngredientsInterface
{
    /**
     *
     *
     * @return IngredientInterface[]
     */
    public function getIngredients(): array;
}