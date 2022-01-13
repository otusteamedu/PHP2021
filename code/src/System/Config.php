<?php

declare(strict_types=1);

namespace App\System;

use PDO;
use PDOException;

class Config{

    private string $host;
    private string $port;
    private string $db;
    private string $user;
    private string $password;

    private string $dsn;


    public function __construct()
    {
       $ini = parse_ini_file('config.ini');

       $this->host = $ini['host'];
       $this->port = $ini['port'];
       $this->db = $ini['db'];
       $this->user = $ini['user'];
       $this->password = $ini['password'];
    }


    private function connectDB(): PDO
    {
        try {
            $this->dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->db;";

            // Make a database connection
            return new PDO(
                $this->dsn,
                $this->user,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function run(): PDO
    {
        return $this->connectDB();
    }




}
