<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.02.2022
 * Time: 15:53
 */

namespace app;

use app\repositories\store\ElasticSearchStoreRepository;
use app\services\StatisticService;
use Exception;

/**
 * Статистика по каналу
 *
 * Class StatisticApp
 * @package app
 */
class StatisticApp
{
    /**
     * ID канала
     *
     * @var string
     */
    private string $channelId;

    /**
     * Количество лучших каналов
     *
     * @var int
     */
    private int $countChannels;

    /**
     * @param string $channelId
     * @param int $countChannels
     */
    public function __construct(string $channelId, int $countChannels)
    {
        $this->channelId = $channelId;
        $this->countChannels = $countChannels;
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
        $countChannels = $this->countChannels;

        $service = new StatisticService(
            ElasticSearchStoreRepository::factory()
        );

        $result = $service->videoLikesByChannelId($channelId);
        print_r($result);

        $result = $service->bestChannels($countChannels);
        print_r($result);
    }
}
