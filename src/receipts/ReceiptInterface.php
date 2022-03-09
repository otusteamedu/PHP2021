<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:15
 */

namespace app\receipts;


use app\dishes\DishIngredientsInterface;

/**
 * Рецепт
 *
 * Class ReceiptInterface
 * @package app\receipts
 */
interface ReceiptInterface extends DishIngredientsInterface
{
    /**
     * Название блюда
     *
     * @return string
     */
    public static function getTitle(): string;
}