<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:28
 */

namespace app\ingredients;

/**
 * Ингредиент
 *
 * Class SausageIngredient
 * @package app\ingredients
 */
class SausageIngredient implements IngredientInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Сасиса";
    }
}
