<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:15
 */

namespace app\models\elasticSearch;


/**
 * Модель канала ElasticSearch
 *
 * Class ElasticSearchChannelModel
 * @package app\models\elasticSearch
 */
class ESChannelModel implements ElasticSearchModelInterface
{
    /** @var string */
    public const INDEX = 'channel';

    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * ChannelModel constructor.
     * @param string $id
     * @param string $title
     */
    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
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
            ],
        ];
    }
}
