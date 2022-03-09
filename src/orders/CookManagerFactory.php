<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 17:48
 */

namespace app\orders;

use app\events\EventManager;
use app\events\OrderListener;

/**
 * Создание повара
 *
 * Class CookManagerFactory
 * @package app\orders
 */
class CookManagerFactory
{
    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Создание повара
     *
     * @param Order $order
     * @return CookManagerInterface
     */
    public static function base(Order $order): CookManagerInterface
    {
        $eventManager = new EventManager();
        $eventManager->subscribe(new OrderListener());

        return new CookManager($order, $eventManager);
    }

    /**
     * Создание повара-ревизора
     *
     * @param Order $order
     * @return CookManagerInterface
     */
    public static function checker(Order $order): CookManagerInterface
    {
        /** @var CookManager $cookManager */
        $cookManager = self::base($order);

        return new CookManagerChecker($cookManager);
    }
}
