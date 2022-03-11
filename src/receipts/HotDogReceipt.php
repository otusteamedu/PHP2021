<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.03.2022
 * Time: 16:27
 */

namespace app\receipts;

use app\dishes\Dish;
use app\dishes\ingredients\ChileSauceIngredient;
use app\dishes\ingredients\LavashIngredient;
use app\dishes\ingredients\SausageIngredient;
use app\products\ProductFactory;

/**
 * Рецепт ХотДог
 *
 * Class HotDogReceipt
 * @package app\receipts
 */
class HotDogReceipt implements ReceiptInterface
{
    /**
     * @inheritDoc
     */
    public function make(): Dish
    {
        $dish = ProductFactory::hotDog();

        $dish = LavashIngredient::addToDish($dish);
        $dish = SausageIngredient::addToDish($dish);

        return ChileSauceIngredient::addToDish($dish);
    }
}
