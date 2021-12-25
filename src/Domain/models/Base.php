<?php

namespace App\Domain\Models;

use App\Application\Services\Config;

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
                Config::getApp('DSN_DB'), Config::getApp('USERNAME_DB'), Config::getApp('PASSWORD_DB')
            );
        }
        return self::$pdo;
    }
}