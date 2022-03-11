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
use app\dishes\ingredients\CheeseIngredient;
use app\dishes\ingredients\SausageIngredient;
use app\products\ProductFactory;

/**
 * Рецепт Сэндвич
 *
 * Class SandwichReceipt
 * @package app\receipts
 */
class SandwichReceipt implements ReceiptInterface
{
    /**
     * @inheritDoc
     */
    public function make(): Dish
    {
        $dish = ProductFactory::sandwich();

        $dish = BreadIngredient::addToDish($dish);
        $dish = CheeseIngredient::addToDish($dish);

        return SausageIngredient::addToDish($dish);
    }
}
