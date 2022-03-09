<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.03.2022
 * Time: 12:12
 */

namespace app\receipts;


/**
 * Выбор продукта
 *
 * Class ReceiptCreateFactory
 * @package app\dishes
 */
class ReceiptCreateFactory
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
        return new Burger();
    }

    /**
     * Бутер
     *
     * @return ReceiptInterface
     */
    public static function sandwich(): ReceiptInterface
    {
        return new Sandwich();
    }

    /**
     * Хвост-дог
     *
     * @return ReceiptInterface
     */
    public static function hotDog(): ReceiptInterface
    {
        return new HotDog();
    }
}
