<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 18:00
 */

namespace app\dishes;

use app\ingredients\IngredientInterface;
use app\receipts\ReceiptInterface;

/**
 * Менеджер блюда (стратегия)
 *
 * Class DishManager
 * @package app\dishes
 */
class DishManager
{
    /**
     * Рецепт
     *
     * @var ReceiptInterface
     */
    private ReceiptInterface $receipt;

    /**
     * Установка рецепта
     *
     * @param ReceiptInterface $receipt
     * @return void
     */
    public function setReceipt(ReceiptInterface $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Блюдо
     *
     * @return Dish
     */
    public function getDish(): Dish
    {
        $receipt = $this->receipt;

        return new Dish($receipt);
    }
}
