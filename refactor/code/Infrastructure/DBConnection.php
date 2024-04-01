<?php

namespace Infrastructure;

use PDO;
use Presentation\Contracts\Connection;

class DBConnection implements Connection
{
    private static $dbname = 'super_hero_storage';
    private static $username = 'batman';
    private static $password = 'wayne';
    private static $host = 'pg_db';
    private static $port = 5432;
    private static $options = [];

    public function createConnection(): PDO
    {
        $dsn = 'pgsql:host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$dbname;

        return new PDO($dsn, self::$username, self::$password, self::$options);
    }
}
