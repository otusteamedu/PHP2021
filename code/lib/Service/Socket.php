<?php

namespace App\Service;

use Exception;

class Socket
{
    private $config;
    private $socket;
    private $connection;

    public function __construct()
    {
        $this->config = parse_ini_file('./configs/config.ini');
    }

    public function getPath()
    {
        return $this->config['path'];
    }

    /**
     * @throws Exception
     */
    private function initializeSocket()
    {
        echo 'Инициализирую сокет...'.PHP_EOL;
        $this->socket = socket_create(AF_UNIX,SOCK_STREAM,0);

        if (socket_bind($this->socket, $this->getPath()) === false) {
            throw new Exception("Не удалось привязать имя к сокету");
        }

        $result = socket_listen($this->socket);
        if (!$result) {
            throw new Exception("Не удалось начать прослушивание");
        }
        echo "Сокет инициализирован".PHP_EOL;
    }

    /**
     * @throws Exception
     */
    private function initializeConnection()
    {
        echo "Поднимаю соединение...".PHP_EOL;
        $this->connection = socket_accept($this->socket);
        if (!$this->connection) {
            throw new Exception("Не удалось поднять соединение");
        }
        echo "Соединение поднято".PHP_EOL;
    }

    public function closeConnectionAndSocket()
    {
        if ($this->connection) {
            socket_close($this->connection);
        }

        if ($this->socket) {
            socket_close($this->socket);
        }

        unlink($this->getPath());
        echo "Соединение и сокет закрыты".PHP_EOL;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @throws Exception
     */
    public function initializeServer()
    {
        $this->closeConnectionAndSocket();
        $this->initializeSocket();
        $this->initializeConnection();
        return $this->getConnection();
    }
}