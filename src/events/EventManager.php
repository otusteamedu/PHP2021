<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 16:30
 */

namespace app\events;

/**
 *
 *
 * Class EventManager
 * @package app\events
 */
class EventManager
{
    /**
     * Подписчики
     *
     * @var ListenerInterface[]
     */
    private array $listeners = [];

    public function subscribe(ListenerInterface $event)
    {
        $className = get_class($event);
        $this->listeners[$className] = $event;
    }

    public function unSubscribe(ListenerInterface $event)
    {
        $className = get_class($event);
        unset($className, $this->listeners);
    }

    public function notify(EventInterface $event)
    {
        $listeners = $this->listeners;

        foreach ($listeners as $listener) {
            $listener->notify($event);
        }
    }
}
