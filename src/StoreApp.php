<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.02.2022
 * Time: 15:53
 */

namespace app;

use app\services\AppServiceFactory;
use Exception;

/**
 * Добавление данных о канале видео
 *
 * Class StoreApp
 * @package app
 */
class StoreApp
{
    /**
     * ID канала
     *
     * @var string
     */
    private string $channelId;

    /**
     * @param string $channelId
     */
    public function __construct(string $channelId)
    {
        $this->channelId = $channelId;
    }

    /**
     * Выполнение
     *
     * @return void
     * @throws Exception
     */
    public function execute()
    {
        $channelId = $this->channelId;
        $service = AppServiceFactory::create();

        $service->storeChannel($channelId);
        $service->storeVideos($channelId);
    }
}
