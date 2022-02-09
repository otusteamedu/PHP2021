<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:21
 */

namespace app\repositories\source;

use app\adapters\YoutubeAdapter;
use app\entities\ChannelEntity;
use app\entities\VideoEntity;
use app\models\youtube\YoutubeVideoModel;

/**
 * Источник данных - Youtube
 *
 * Class YoutubeSourceRepository
 * @package app\repositories\source
 */
class YoutubeSourceRepository implements SourceRepositoryInterface
{
    /**
     * Youtube адаптер данных
     *
     * @var YoutubeAdapter
     */
    private YoutubeAdapter $youtubeAdapter;

    /**
     * @param YoutubeAdapter $youtubeAdapter
     */
    public function __construct(YoutubeAdapter $youtubeAdapter)
    {
        $this->youtubeAdapter = $youtubeAdapter;
    }

    /**
     * @inheritDoc
     */
    public static function factory(): SourceRepositoryInterface
    {
        $adapter = new YoutubeAdapter();

        return new self($adapter);
    }

    /**
     * @inheritDoc
     */
    public function getChannelById(string $channelId): ?ChannelEntity
    {
        $channelModel = $this
            ->youtubeAdapter
            ->channelById($channelId);

        if ($channelModel === null) {
            return null;
        }

        return new ChannelEntity(
            $channelModel->getId(),
            $channelModel->getTitle()
        );
    }

    /**
     * @inheritDoc
     */
    public function getVideoListByChannelId(string $channelId): array
    {
        $videoIds = $this
            ->youtubeAdapter
            ->videoIdsByChannelId($channelId);

        $videoModels = $this
            ->youtubeAdapter
            ->videoListByIds($videoIds);

        return array_map(
            static function (YoutubeVideoModel $model) {
                return new VideoEntity(
                    $model->getId(),
                    $model->getTitle(),
                    $model->getChannelId(),
                    $model->getLikeCount(),
                    $model->getDislikeCount()
                );
            },
            $videoModels
        );
    }
}
