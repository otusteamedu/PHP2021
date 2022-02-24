<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 23.02.2022
 * Time: 11:54
 */

namespace app\infrastructure\singletons;

use Exception;
use Redis;

/**
 * Адаптер для редиса
 *
 * Class RedisSingleton
 * @package app\infrastructure\singletons
 */
class RedisSingleton
{
    /**
     * Подключение к Redis
     *
     * @var Redis|null
     */
    static private ?Redis $instance = null;

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Создание объекта Redis
     *
     * @return Redis
     * @throws Exception
     */
    public static function instance(): Redis
    {
        if (self::$instance === null) {
            $instance = new self();
            $instance->connect();
        }

        return self::$instance;
    }

    /**
     * Подключение к Redis
     *
     * @return void
     * @throws Exception
     */
    private function connect()
    {
        $hostName = getenv('REDIS_HOST');

        if ($hostName === false) {
            throw new Exception("REDIS_HOST can not to be empty");
        }

        $redis = new Redis();
        $isConnected = $redis->connect($hostName);

        if ($isConnected === false) {
            throw new Exception("Redis can not connect");
        }

        self::$instance = $redis;
    }
}
