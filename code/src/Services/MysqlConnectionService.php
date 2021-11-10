<?php

namespace App\Services;

use PDO;

class MysqlConnectionService
{
    private static ?PDO $connection = null;

    private function __construct()
    {

    }

    public static function getConnection(): PDO
    {
        if (!static::$connection) {
            $dsn = 'mysql:host=' . Config::get('mysql_host')
                . ';port=' . Config::get('mysql_port')
                . ';dbname=' . Config::get('mysql_db_name');

            $user = Config::get('mysql_user');
            $password = Config::get('mysql_password');

            static::$connection = new PDO($dsn, $user, $password);
        }

        return static::$connection;
    }
}
