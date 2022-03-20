<?php

namespace App\Adapters;

use PDO;

class DBConnection
{
    private static $dbname = 'bender';

    private static $username = 'bender';

    private static $password = 'bender';

    private static $host = 'pg_db';

    private static $port = 5432;

    private static $options = [];

    public function createConnection()
    {
        $dsn = "pgsql:host=".self::$host.";port=".self::$port.";dbname=".self::$dbname;

        return new PDO($dsn, self::$username, self::$password, self::$options);
    }
}
