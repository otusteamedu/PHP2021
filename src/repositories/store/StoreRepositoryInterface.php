<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:01
 */

namespace app\repositories\store;

use app\entities\ChannelEntity;
use app\entities\VideoLikeStatisticEntity;
use app\entities\VideoEntity;

/**
 * Интерфейс хранилища данных
 *
 * Class StoreRepositoryInterface
 * @package app\repositories\store
 */
interface StoreRepositoryInterface
{
    /**
     * Фабричный метод создания хранилища
     *
     * @return StoreRepositoryInterface
     */
    public static function create(): StoreRepositoryInterface;

    /**
     * Сохранение канала
     *
     * @param ChannelEntity $channel
     *
     * @return void
     */
    public function saveChannel(ChannelEntity $channel);

    /**
     * Сохранение видео
     *
     * @param VideoEntity $video
     *
     * @return void
     */
    public function saveVideo(VideoEntity $video);

    /**
     * Статистика лайков/диз лайков видео канала
     *
     * @param string $channelId
     *
     * @return VideoLikeStatisticEntity|null
     */
    public function statisticByChannelId(string $channelId): ?VideoLikeStatisticEntity;

    /**
     * Статистика лучших N каналов
     *
     * @param int $countTotal
     *
     * @return VideoLikeStatisticEntity[]
     */
    public function statisticBestChannels(int $countTotal): array;
}
