<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:15
 */

namespace app\models\elasticSearch;


/**
 * Модель статистика лайков/диз лайков ElasticSearch
 *
 * Class ElasticSearchLikeStatisticModel
 * @package app\models\elasticSearch
 */
class ESVideoLikeStatisticModel implements ElasticSearchModelInterface
{
    /** @var string */
    public const INDEX = 'video';

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
     * @inheritDoc
     */
    public function getIndexParams(): array
    {
        return [
            'index' => self::INDEX,
            'body' => [
                'query' => [
                    'match' => [
                        'channel_id' => $this->channelId,
                    ],
                ],
                'size' => 0,
                'aggs' => [
                    'like_count' => [
                        'sum' => [
                            'field' => 'like_count',
                        ],
                    ],
                    'dislike_count' => [
                        'sum' => [
                            'field' => 'dislike_count',
                        ],
                    ],
                ],
            ],
        ];
    }
}
