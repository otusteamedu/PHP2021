<?php

namespace App\Server;

use App\Service\Socket;
use Exception;

class Server
{
    private $socket;
    private $connection;

    public function run()
    {
        try {
            $this->initializeSocket();
            $this->initializeConnection();
            $this->acceptMessage();
        } catch (Exception $e) {
            echo $e->getMessage().PHP_EOL;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }


    /**
     * @throws Exception
     */
    private function initializeSocket()
    {
        echo 'Инициализирую сокет...'.PHP_EOL;
        $this->socket = socket_create(AF_UNIX,SOCK_STREAM,0);

        if (socket_bind($this->socket, (new Socket())->getPath()) === false) {
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

    private function acceptMessage()
    {
        echo "Ожидаю сообещения...".PHP_EOL;
        do {
            $message = socket_read($this->connection, 1024);
            $len = strlen($message);
            socket_write($this->connection, "Received {$len}bytes".PHP_EOL);
            echo $message.PHP_EOL;
        } while ($message !== 'exit');
    }

    private function closeConnectionAndSocket()
    {
        if ($this->connection) {
            socket_close($this->connection);
        }

        if ($this->socket) {
            socket_close($this->socket);
        }

        unlink(self::SOCKET_PATH);
        echo "Соединение и сокет закрыты".PHP_EOL;
    }
}