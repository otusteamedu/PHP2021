<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 16:58
 */

namespace app\events;

use app\orders\Order;

/**
 * Событие по заказу
 *
 * Class OrderEvent
 * @package app\events
 */
class OrderEvent implements EventInterface
{
    /**
     * Заказ
     *
     * @var Order
     */
    private Order $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
