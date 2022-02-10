<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.02.2022
 * Time: 15:45
 */

namespace app;

use app\services\AppServiceFactory;
use Exception;

/**
 * Паук
 *
 * Class Spider
 * @package app
 */
class SpiderApp
{
    /**
     * Список каналов для парсинга
     *
     * @var array
     */
    private array $channels;

    /**
     * @param array $channels
     */
    public function __construct(array $channels)
    {
        $this->channels = $channels;
    }

    /**
     * @throws Exception
     */
    public function execute()
    {
        $channels = $this->channels;
        $service = AppServiceFactory::create();

        foreach ($channels as $channelId) {
            $service->storeChannel($channelId);
            $service->storeVideos($channelId);
        }
    }
}

