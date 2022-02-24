<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 24.02.2022
 * Time: 12:06
 */

namespace app\infrastructure\helpers;

/**
 * Хелпер для Redis
 *
 * Class RedisHelper
 * @package app\infrastructure\helpers
 */
class RedisEventHelper
{
    /** @var string Ключ приоритетов событий */
    public const EVENTS_PRIORITY_KEY = 'events:priority';

    /** @var string Префикс ключа события */
    public const EVENT_PREFIX_KEY = 'event';

    /**
     * Ключ в базе приоритетов событий
     *
     * @return string
     */
    public static function getPriorityKey(): string
    {
        return self::EVENTS_PRIORITY_KEY;
    }

    /**
     * Ключ в базе параметров события
     *
     * @param string $eventName
     * @return string
     */
    public static function getParamsKey(string $eventName): string
    {
        return self::EVENT_PREFIX_KEY . ':' . $eventName . ':params';
    }

    /**
     * Ключ в базе данных события
     *
     * @param string $eventName
     * @return string
     */
    public static function getDataKey(string $eventName): string
    {
        return self::EVENT_PREFIX_KEY . ':' . $eventName . ':data';
    }
}
