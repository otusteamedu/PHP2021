<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.03.2022
 * Time: 19:59
 */

namespace app\receipts;

use Exception;

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
     * Поиск рецепта
     *
     * @throws Exception
     */
    public static function create(string $receiptName): ReceiptInterface
    {
        switch ($receiptName) {
            case 'burger':
                $receipt = self::burger();

                break;
            case 'sandwich':
                $receipt = self::sandwich();

                break;
            case 'hotDog':
                $receipt = self::hotDog();

                break;
            default:
                throw new Exception("Рецепт не найден");
        }

        return $receipt;
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
