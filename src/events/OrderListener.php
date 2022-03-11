<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 16:53
 */

namespace app\events;

use app\orders\Order;

/**
 * Уведомление по заказу
 *
 * Class ConsoleListener
 * @package app\events
 */
class OrderListener implements ListenerInterface
{
    /**
     * @inheritDoc
     */
    public function notify(EventInterface $event)
    {
        /** @var OrderEvent $event */
        $order = $event->getOrder();

        switch ($order->getStatus())
        {
            case $order::STATUS_CREATED:
                $this->notifyCreate();

                break;

            case $order::STATUS_DONE:
                $this->notifyDone($order);

                break;
        }

        echo PHP_EOL;
    }

    /**
     * @return void
     */
    private function notifyCreate()
    {
        echo "Событие: Заказ создан";
    }

    /**
     * @param Order $order
     * @return void
     */
    private function notifyDone(Order $order)
    {
        $dish = $order->getDish();
        $ingredients = $dish->getIngredients();

        echo "Событие: Заказ выполнен" . PHP_EOL;
        echo "Ингредиенты:" . PHP_EOL;

        foreach ($ingredients as $ingredient) {
            echo " - " . $ingredient . PHP_EOL;
        }
    }
}
