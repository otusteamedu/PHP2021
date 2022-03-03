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
     * @param int $id
     * @param string $email
     * @param string $userName
     */
    public function __construct(
        int    $id,
        string $email,
        string $userName
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->userName = $userName;
    }

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
     * @inheritDoc
     */
    public static function instance(array $queryData): BaseActiveRecord
    {
        return new self(
            (int)$queryData['id'],
            $queryData['email'],
            $queryData['user_name']
        );
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
}

