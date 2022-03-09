<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 17:17
 */

namespace app\orders;

/**
 * Заказ
 *
 * Class CookManagerInterface
 * @package app\orders
 */
interface CookManagerInterface
{
    /**
     * Начало приготовления
     *
     * @return void
     */
    public function start();

    /**
     * Конец приготовления
     *
     * @return void
     */
    public function done();
}