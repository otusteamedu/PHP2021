<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 17:18
 */

namespace app\orders;

use app\events\EventManager;
use app\events\OrderEvent;

/**
 * Приготовление заказа
 *
 * Class CookManager
 * @package app\orders
 */
class CookManager implements CookManagerInterface
{
    /**
     * Заказ
     *
     * @var Order
     */
    private Order $order;

    /**
     * Менеджер событий
     *
     * @var EventManager
     */
    private EventManager $eventManager;

    /**
     * @param Order $order
     * @param EventManager $eventManager
     */
    public function __construct(Order $order, EventManager $eventManager)
    {
        $this->order = $order;
        $this->eventManager = $eventManager;
    }

    /**
     * Начало выполнения заказа
     *
     * @return void
     */
    public function start()
    {
        $order = $this->order;
        $eventManager = $this->eventManager;

        $order->startCook();
        $event = new OrderEvent($order);

        $eventManager->notify($event);
    }

    /**
     * Заказ выполнен
     *
     * @return void
     */
    public function done()
    {
        $order = $this->order;
        $eventManager = $this->eventManager;

        $order->doneCook();
        $event = new OrderEvent($order);

        $eventManager->notify($event);
    }

    /**
     * Утилизация
     *
     * @return void
     */
    public function cancel()
    {
        $order = $this->order;
        $eventManager = $this->eventManager;

        $order->cancelCook();
        $event = new OrderEvent($order);

        $eventManager->notify($event);
    }

    /**
     * Утилизация
     *
     * @return void
     */
    public function trash()
    {
        $order = $this->order;
        $eventManager = $this->eventManager;

        $order->sendToTrash();
        $event = new OrderEvent($order);

        $eventManager->notify($event);
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
