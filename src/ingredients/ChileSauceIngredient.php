<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 15:31
 */

namespace app\ingredients;

/**
 * Ингредиент
 *
 * Class ChileSauceIngredient
 * @package app\ingredients
 */
class ChileSauceIngredient implements IngredientInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Соус чили";
    }
}
