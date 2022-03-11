<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 17:48
 */

namespace app\orders;

use app\dishes\Dish;
use app\events\EventManager;
use app\events\OrderListener;

/**
 * Создание менеджера заказа
 *
 * Class CookManagerFactory
 * @package app\orders
 */
class OrderManagerFactory
{
    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Создание менеджера заказа
     *
     * @param Dish $dish
     * @return OrderManagerInterface
     */
    public static function create(Dish $dish): OrderManagerInterface
    {
        $eventManager = new EventManager();
        $eventManager->subscribe(new OrderListener());

        $order = new Order($dish);

        return new OrderManager($order, $eventManager);
    }

    /**
     * Создание менеджера заказа с проверкой
     *
     * @param Dish $dish
     * @return OrderManagerInterface
     */
    public static function checker(Dish $dish): OrderManagerInterface
    {
        /** @var OrderManager $cookManager */
        $cookManager = self::create($dish);

        return new OrderManagerChecker($cookManager);
    }
}
