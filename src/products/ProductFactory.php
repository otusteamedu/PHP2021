<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.03.2022
 * Time: 17:19
 */

namespace app\products;

/**
 * Фабрика продуктов
 *
 * Class BurgerFactory
 * @package app\products
 */
class ProductFactory
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
     * @return Product
     */
    public static function burger(): Product
    {
        return new Product("Бургер");
    }

    /**
     * Сэндвич
     *
     * @return Product
     */
    public static function sandwich(): Product
    {
        return new Product("Бутер");
    }

    /**
     * ХотДог
     *
     * @return Product
     */
    public static function hotDog(): Product
    {
        return new Product("Хвост-дог");
    }
}
