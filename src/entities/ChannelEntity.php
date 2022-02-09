<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:32
 */

namespace app\entities;

/**
 * Сущность канала
 *
 * Class ChannelEntity
 * @package entities
 */
class ChannelEntity
{
    /**
     * ID канала
     *
     * @var string
     */
    private string $id;

    /**
     * Название канала
     *
     * @var string
     */
    private string $title;

    /**
     * @param string $id
     * @param string $title
     */
    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
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
}
