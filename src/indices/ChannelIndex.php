<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 18:51
 */

namespace app\indices;

use app\models\ChannelModel;

/**
 * Class ChannelIndex
 * @package app\indices
 */
class ChannelIndex implements BaseIndex
{
    /**
     * @var ChannelModel
     */
    private ChannelModel $channelModel;

    /**
     * ChannelIndex constructor.
     * @param ChannelModel $channelModel
     */
    public function __construct(ChannelModel $channelModel)
    {
        $this->channelModel = $channelModel;
    }

    /**
     * @inheritdoc
     */
    public static function index(): string
    {
        return 'channel';
    }

    /**
     * @inheritdoc
     */
    public function toParams(): array
    {
        $channelModel = $this->channelModel;

        return [
            'index' => self::index(),
            'id' => $channelModel->getId(),
            'body' => [
                'title' => $channelModel->getTitle(),
            ],
        ];
    }
}