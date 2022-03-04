<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 02.03.2022
 * Time: 18:50
 */

namespace app;

/**
 * Модель пользователя
 *
 * Class UserModel
 * @package app
 */
class UserModel extends BaseActiveRecord
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $userName;

    /**
     * @inheritDoc
     */
    public function getPrimaryKey(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }
}

