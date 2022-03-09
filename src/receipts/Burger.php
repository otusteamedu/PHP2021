<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:17
 */

namespace app\receipts;

use app\ingredients\BreadIngredient;
use app\ingredients\MeatIngredient;
use app\ingredients\SauceIngredient;

/**
 * Рецепт бургер
 *
 * Class Burger
 * @package app\receipts
 */
class Burger implements ReceiptInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Бургер";
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return  [
            new BreadIngredient(),
            new MeatIngredient(),
            new SauceIngredient(),
            new BreadIngredient(),
        ];
    }
}
