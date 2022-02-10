<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:08
 */

namespace app\repositories\store;

use app\adapters\ElasticSearchAdapter;
use app\entities\BestChannelsStatisticEntity;
use app\entities\VideoLikeStatisticEntity;
use app\entities\VideoEntity;
use app\models\elasticSearch\ESBestChannelsStatisticModel;
use app\models\elasticSearch\ESChannelModel;
use app\entities\ChannelEntity;
use app\models\elasticSearch\ESVideoLikeStatisticModel;
use app\models\elasticSearch\ESVideoModel;

/**
 * Репозиторий хранения данных - ElasticSearch
 *
 * Class ElasticSearchStoreRepository
 * @package app\repositories\store
 */
class ElasticSearchStoreRepository implements StoreRepositoryInterface
{
    /**
     * Клиент ElasticSearch
     *
     * @var ElasticSearchAdapter
     */
    private ElasticSearchAdapter $elasticSearchAdapter;

    /**
     * @param ElasticSearchAdapter $elasticSearchAdapter
     */
    public function __construct(ElasticSearchAdapter $elasticSearchAdapter)
    {
        $this->elasticSearchAdapter = $elasticSearchAdapter;
    }

    /**
     * @inheritDoc
     */
    public static function create(): StoreRepositoryInterface
    {
        $adapter = new ElasticSearchAdapter();

        return new self($adapter);
    }

    /**
     * @inheritDoc
     */
    public function saveChannel(ChannelEntity $channel)
    {
        $channelModel = new ESChannelModel(
            $channel->getId(),
            $channel->getTitle()
        );

        $this
            ->elasticSearchAdapter
            ->index($channelModel);
    }

    /**
     * @inheritDoc
     */
    public function saveVideo(VideoEntity $video)
    {
        $channelModel = new ESVideoModel(
            $video->getId(),
            $video->getTitle(),
            $video->getChannelId(),
            $video->getLikeCount(),
            $video->getDislikeCount()
        );

        $this
            ->elasticSearchAdapter
            ->index($channelModel);
    }

    /**
     * @inheritDoc
     */
    public function statisticByChannelId(string $channelId): ?VideoLikeStatisticEntity
    {
        $statisticModel = new ESVideoLikeStatisticModel($channelId);

        $result = $this
            ->elasticSearchAdapter
            ->search($statisticModel);

        if (isset($result['aggregations']) === false) {
            return null;
        }

        $likeCount = $result['aggregations']['like_count']['value'];
        $dislikeCount = $result['aggregations']['dislike_count']['value'];

        return new VideoLikeStatisticEntity(
            $channelId,
            $likeCount,
            $dislikeCount
        );
    }

    /**
     * @inheritDoc
     */
    public function statisticBestChannels(int $countTotal): array
    {
        $statisticModel = new ESBestChannelsStatisticModel($countTotal);

        $result = $this
            ->elasticSearchAdapter
            ->search($statisticModel);

        if (isset($result['aggregations']) === false) {
            return [];
        }

        $topChannels = $result['aggregations']['top_channels']['buckets'];

        return array_map(
            static function (array $datum) {
                return new BestChannelsStatisticEntity(
                    $datum['key'],
                    $datum['sum_likes']['value']
                );
            },
            $topChannels
        );
    }
}
