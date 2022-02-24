<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 23.02.2022
 * Time: 16:25
 */

namespace app\infrastructure\repositories\handlers;

use app\infrastructure\helpers\RedisEventHelper;
use Redis;

/**
 * Удаление событий
 *
 * Class RedisEventCleanHandler
 * @package app\infrastructure\repositories\handlers
 */
class RedisEventClearHandler
{
    /**
     * Экземпляр Redis
     *
     * @var Redis
     */
    private Redis $redis;

    /**
     * @param Redis $redis
     */
    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Выполнение
     *
     * @return void
     */
    public function run()
    {
        $redis = $this->redis;
        $pattern = RedisEventHelper::EVENT_PREFIX_KEY . '*';

        $keys = $redis->keys($pattern);
        if (empty($keys) === true) {
            return;
        }

        $redis->del($keys);
    }
}
