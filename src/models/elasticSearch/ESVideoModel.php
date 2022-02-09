<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:15
 */

namespace app\models\elasticSearch;


/**
 * Модель видео ElasticSearch
 *
 * Class ElasticSearchVideoModel
 * @package app\models\elasticSearch
 */
class ESVideoModel implements ElasticSearchModelInterface
{
    /** @var string */
    public const INDEX = 'video';

    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $channelId;

    /**
     * @var int
     */
    private int $likeCount;

    /**
     * @var int
     */
    private int $dislikeCount;

    /**
     * ChannelModel constructor.
     * @param string $id
     * @param string $title
     * @param string $channelId
     * @param int $likeCount
     * @param int $dislikeCount
     */
    public function __construct(
        string $id,
        string $title,
        string $channelId,
        int    $likeCount,
        int    $dislikeCount
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->channelId = $channelId;
        $this->likeCount = $likeCount;
        $this->dislikeCount = $dislikeCount;
    }

    /**
     * @inheritDoc
     */
    public function getIndexParams(): array
    {
        return [
            'index' => self::INDEX,
            'id' => $this->id,
            'body' => [
                'title' => $this->title,
                'channel_id' => $this->channelId,
                'like_count' => $this->likeCount,
                'dislike_count' => $this->dislikeCount,
            ],
        ];
    }
}
