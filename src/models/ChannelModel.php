<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:15
 */

namespace app\models;

/**
 * Class ChannelModel
 * @package app\models
 */
class ChannelModel
{
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
}