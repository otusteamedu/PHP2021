<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.03.2022
 * Time: 16:32
 */

namespace app\events;

/**
 * Подписчик
 *
 * Class ListenerInterface
 * @package app\events
 */
interface ListenerInterface
{
    /**
     * Уведомление
     *
     * @return void
     */
    public function notify(EventInterface $event);
}
