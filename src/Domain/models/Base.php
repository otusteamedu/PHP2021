<?php

namespace App\Domain\Models;

class Base
{
    /**
     * @var \PDO
     */
    protected static $pdo;

    /**
     * Подключение к базе данных
     * @return \PDO
     */
    protected function getConnect()
    {
        if (self::$pdo === null) {
            self::$pdo = new \PDO(
                DSN_DB, USERNAME_DB, PASSWORD_DB
            );
        }
        return self::$pdo;
    }
}