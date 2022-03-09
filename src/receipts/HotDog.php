<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:20
 */

namespace app\receipts;


use app\ingredients\LavashIngredient;
use app\ingredients\SauceIngredient;
use app\ingredients\SausageIngredient;

/**
 * Рецепт ХотДог
 *
 * Class HotDog
 * @package app\receipts
 */
class HotDog implements ReceiptInterface
{
    /**
     * @inheritDoc
     */
    public static function getTitle(): string
    {
        return "Хвост-дог";
    }

    /**
     * @inheritDoc
     */
    public function getIngredients(): array
    {
        return [
            new LavashIngredient(),
            new SauceIngredient(),
            new SausageIngredient(),
        ];
    }
}
