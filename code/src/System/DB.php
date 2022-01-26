<?php

declare(strict_types=1);

namespace App\System;

use PDO;
use PDOException;

class DB{

    private DB $instance;

    private PDO $pdo;

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

    public function getInstance() : DB
    {
        if(empty($this->instance)){
            $this->instance = new self();
        }
        return $this->instance;
    }

    public function connectDB(): PDO
    {
        try {
            $this->dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->db;";

            // Make a database connection
            return  $this->pdo = new PDO(
                $this->dsn,
                $this->user,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            echo $e->getMessage().PHP_EOL;
            exit;
        }
    }

    public function getPDO(): PDO
    {
        if(! $this->pdo instanceof PDO){
            throw new \PDOException('Проблема соединения с базой');
        }

        return  $this->pdo;
    }

    /*public function run(): PDO
    {
        return $this->connectDB();
    }*/




}
