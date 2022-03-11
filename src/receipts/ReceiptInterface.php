<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.03.2022
 * Time: 16:28
 */

namespace app\receipts;

use app\dishes\Dish;

/**
 * Рецепт
 *
 * Class ReceiptInterface
 * @package app\receipts
 */
interface ReceiptInterface
{
    /**
     * Создание блюда
     *
     * @return Dish
     */
    public function make(): Dish;
}