<?php

namespace App\Postgresql;

use PDO;

class ConnectPDO
{

    public function Connect(): PDO
    {
        $host = 'postgres';
        $dbname = 'stage';
        $username = 'postgres';
        $password = 'secret';
        $connection = new PDO("pgsql:host=$host;dbname=$dbname",$username,$password);

        return $connection;
    }
}