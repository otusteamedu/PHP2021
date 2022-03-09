<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:18
 */

namespace app\receipts;

use app\ingredients\BreadIngredient;
use app\ingredients\ChileSauceIngredient;
use app\ingredients\MeatIngredient;

/**
 * Рецепт сэндвича
 *
 * Class Sandwich
 * @package app\receipts
 */
class Sandwich implements ReceiptInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Бутер";
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return [
            new BreadIngredient(),
            new ChileSauceIngredient(),
            new MeatIngredient(),
        ];
    }
}
