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
                Config::get('DSN_DB'), Config::get('USERNAME_DB'), Config::get('PASSWORD_DB')
            );
        }
        return self::$pdo;
    }
}