<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.03.2022
 * Time: 19:59
 */

namespace app\receipts;

/**
 * Рецепт
 *
 * Class ReceiptFactory
 * @package app\receipts
 */
class ReceiptFactory
{
    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Бургер
     *
     * @return ReceiptInterface
     */
    public static function burger(): ReceiptInterface
    {
        return new BurgerReceipt();
    }

    /**
     * Бутер
     *
     * @return ReceiptInterface
     */
    public static function sandwich(): ReceiptInterface
    {
        return new SandwichReceipt();
    }

    /**
     * Хвост-дог
     *
     * @return ReceiptInterface
     */
    public static function hotDog(): ReceiptInterface
    {
        return new HotDogReceipt();
    }
}
