<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 10:56
 */

namespace app\services;

use app\repositories\source\SourceRepositoryInterface;
use app\repositories\store\StoreRepositoryInterface;
use Exception;

/**
 * Сервис приложения
 *
 * Class AppService
 * @package app\services
 */
class AppService
{
    /**
     * Репозиторий хранилища данных
     *
     * @var StoreRepositoryInterface
     */
    private StoreRepositoryInterface $storeRepository;

    /**
     * Репозиторий источника данных
     *
     * @var SourceRepositoryInterface
     */
    private SourceRepositoryInterface $sourceRepository;

    /**
     * @param StoreRepositoryInterface $storeRepository
     * @param SourceRepositoryInterface $sourceRepository
     */
    public function __construct(
        StoreRepositoryInterface  $storeRepository,
        SourceRepositoryInterface $sourceRepository
    )
    {
        $this->storeRepository = $storeRepository;
        $this->sourceRepository = $sourceRepository;
    }

    /**
     * Получение и сохранение данных канала
     *
     * @param string $channelId
     *
     * @return void
     * @throws Exception
     */
    public function storeChannel(string $channelId)
    {
        $sourceRepository = $this->sourceRepository;
        $storeRepository = $this->storeRepository;

        $channelEntity = $sourceRepository->getChannelById($channelId);
        if ($channelEntity === null) {
            throw new Exception("Channel $channelId not found");
        }

        $storeRepository->saveChannel($channelEntity);
    }

    /**
     * Получение и сохранение данных видел канала
     *
     * @param string $channelId
     *
     * @return void
     * @throws Exception
     */
    public function storeVideos(string $channelId)
    {
        $sourceRepository = $this->sourceRepository;
        $storeRepository = $this->storeRepository;

        $videoEntities = $sourceRepository->getVideoListByChannelId($channelId);
        if (empty($videoEntities) === true) {
            throw new Exception("Videos by channel $channelId not found");
        }

        foreach ($videoEntities as $entity) {
            $storeRepository->saveVideo($entity);
        }
    }
}
