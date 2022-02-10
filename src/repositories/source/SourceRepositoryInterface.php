<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:20
 */

namespace app\repositories\source;

use app\entities\ChannelEntity;
use app\entities\VideoEntity;

/**
 * Провайдер источника данных
 *
 * Class SourceProviderInterface
 * @package app\repositories\source
 */
interface SourceRepositoryInterface
{
    /**
     * Фабричный метод создания источника
     *
     * @return SourceRepositoryInterface
     */
    public static function create(): SourceRepositoryInterface;

    /**
     * Получение канала по ID
     *
     * @param string $channelId
     *
     * @return ChannelEntity|null
     */
    public function getChannelById(string $channelId): ?ChannelEntity;

    /**
     * Получение видео по ID канала
     *
     * @param string $channelId
     *
     * @return VideoEntity[]
     */
    public function getVideoListByChannelId(string $channelId): array;
}
