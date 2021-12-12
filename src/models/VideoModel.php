<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.12.2021
 * Time: 21:13
 */

namespace app\models;

/**
 * Class VideoModel
 * @package app\models
 */
class VideoModel
{
    /**
     * @var string
     */
    public string $id;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $channelId;
    /**
     * @var int
     */
    public int $likeCount;
    /**
     * @var int
     */
    public int $dislikeCount;

    /**
     * VideoModel constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->setProperties($config);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param array $config
     */
    private function setProperties(array $config)
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key) === false) {
                continue;
            }

            $this->$key = $value;
        }
    }

    /**
     * @return string
     */
    public function getChannelId(): string
    {
        return $this->channelId;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    /**
     * @return int
     */
    public function getDislikeCount(): int
    {
        return $this->dislikeCount;
    }
}