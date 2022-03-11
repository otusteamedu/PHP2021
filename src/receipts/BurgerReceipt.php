<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.03.2022
 * Time: 16:27
 */

namespace app\receipts;

use app\dishes\Dish;
use app\dishes\ingredients\BreadIngredient;
use app\dishes\ingredients\MeatIngredient;
use app\dishes\ingredients\SausageIngredient;
use app\products\ProductFactory;

/**
 * Рецепт бургер
 *
 * Class BurgerReceipt
 * @package app\receipts
 */
class BurgerReceipt implements ReceiptInterface
{
    /**
     * @inheritDoc
     */
    public function make(): Dish
    {
        $dish = ProductFactory::burger();

        $dish = BreadIngredient::addToDish($dish);
        $dish = MeatIngredient::addToDish($dish);
        $dish = SausageIngredient::addToDish($dish);

        return BreadIngredient::addToDish($dish);
    }
}
