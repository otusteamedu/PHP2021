<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:15
 */

namespace app\models\elasticSearch;


/**
 * Модель списка лучших каналов ElasticSearch
 *
 * Class BestChannelsStatisticModel
 * @package app\models\elasticSearch
 */
class ESBestChannelsStatisticModel implements ElasticSearchModelInterface
{
    /** @var string */
    public const INDEX = 'video';

    /**
     * Количество каналов
     *
     * @var int
     */
    private int $count;

    /**
     * @param int $count
     */
    public function __construct(int $count)
    {
        $this->count = $count;
    }

    /**
     * @inheritDoc
     */
    public function getIndexParams(): array
    {
        return [
            'index' => self::INDEX,
            'body' => [
                'runtime_mappings' => [
                    'actual_likes' => [
                        'type' => 'long',
                        'script' => [
                            'source' => "emit(doc['like_count'].value - doc['dislike_count'].value)",
                        ],
                    ],
                ],
                'size' => 0,
                'aggs' => [
                    'top_channels' => [
                        'categorize_text' => [
                            'field' => 'channel_id',
                        ],
                        'aggs' => [
                            'sum_likes' => [
                                'sum' => [
                                    'field' => 'actual_likes',
                                ],
                            ],
                            'sort_likes' => [
                                'bucket_sort' => [
                                    "size" => $this->count,
                                    'sort' => [
                                        'sum_likes' => [
                                            'order' => 'desc',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
