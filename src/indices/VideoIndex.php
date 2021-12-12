<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 18:51
 */

namespace app\indices;

use app\models\VideoModel;

/**
 * Class VideoIndex
 * @package app\indices
 */
class VideoIndex implements BaseIndex
{
    /**
     * @var VideoModel
     */
    private VideoModel $videoModel;

    /**
     * VideoIndex constructor.
     * @param VideoModel $videoModel
     */
    public function __construct(VideoModel $videoModel)
    {
        $this->videoModel = $videoModel;
    }

    /**
     * @inheritdoc
     */
    public static function index(): string
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function toParams(): array
    {
        return [
            'index' => self::index(),
            'id' => $this->getId(),
            'body' => $this->getBody(),
        ];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this
            ->videoModel
            ->getId();
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        $videoModel = $this->videoModel;

        return [
            'title' => $videoModel->getTitle(),
            'channel_id' => $videoModel->getChannelId(),
            'like_count' => $videoModel->getLikeCount(),
            'dislike_count' => $videoModel->getDislikeCount(),
        ];
    }
}
