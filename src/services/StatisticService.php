<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 19:30
 */

namespace app\services;

use app\entities\VideoLikeStatisticEntity;
use app\repositories\store\StoreRepositoryInterface;
use Exception;

/**
 * Сервис статистики
 *
 * Class StatisticService
 * @package app\services
 */
class StatisticService
{
    /**
     * Репозиторий хранилища данных
     *
     * @var StoreRepositoryInterface
     */
    private StoreRepositoryInterface $storeRepository;

    /**
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * Статистика лайков/диз лайков по всем видео канала
     *
     * @param string $channelId
     *
     * @return VideoLikeStatisticEntity
     * @throws Exception
     */
    public function videoLikesByChannelId(string $channelId): VideoLikeStatisticEntity
    {
        $storeRepository = $this->storeRepository;

        $likeStatisticEntity = $storeRepository->statisticByChannelId($channelId);
        if ($likeStatisticEntity === null) {
            throw new Exception("Videos by channelID $channelId not found");
        }

        return $likeStatisticEntity;
    }

    /**
     * Лучшие N каналов
     *
     * @param int $totalCount
     *
     * @return VideoLikeStatisticEntity[]
     * @throws Exception
     */
    public function bestChannels(int $totalCount): array
    {
        $storeRepository = $this->storeRepository;

        $bestChannels = $storeRepository->statisticBestChannels($totalCount);
        if (empty($bestChannels) === true) {
            throw new Exception("Best channels not found");
        }

        return $bestChannels;
    }
}
