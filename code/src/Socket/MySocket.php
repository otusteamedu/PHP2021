<?php

declare(strict_types=1);

namespace App\Socket;

class MySocket
{
    private const SOCKET_PATH = '/tmp/otus-php-sockets11.sock';

    private $socket;

    private $connection;

    public function initializeSocket(): void
    {
        echo "Инициализирую сокет...".PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (socket_bind($this->socket, self::SOCKET_PATH) === false) {
            throw new \Exception("Не удалось привязать имя к сокету");
        }

        $result = socket_listen($this->socket);
        if (!$result) {
            throw new \Exception("Не удалось начать прослушивать соединение");
        }
        echo "Сокет инициализирован".PHP_EOL;
    }

    /**
     * Инициализирует соединение.
     *
     * @throws \Exception
     */
    public function initializeConnection(): void
    {
        echo "Поднимаю соединение...".PHP_EOL;
        $this->connection = socket_accept($this->socket);
        if (!$this->connection) {
            throw new \Exception("Не удалось поднять соединение");
        }
        echo "Соединение поднято".PHP_EOL;
    }
    /**
     * Принимает сообщения до тех пор, пока не получит строку "выход".
     */
    public function acceptMessages(): void
    {
        echo "Ожидаю сообщения...".PHP_EOL;
        do {
            $message = socket_read($this->connection, 1024);
            echo $message.PHP_EOL;
        } while ($message !== 'выход');
    }
    /**
     * Инициализирует соединение.
     *
     * @throws \Exception
     */
    public function addConnection(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        echo "Создание сокета...".PHP_EOL;
        $this->connection = socket_connect( $this->socket, self::SOCKET_PATH );;
        if (!$this->connection) {
            throw new \Exception("Не удалось создать сокет");
        }
        echo "Сокет создан".PHP_EOL;
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "выход".
     */
    public function sendMessages(): void
    {
        echo "Отправляю сообщение...".PHP_EOL;

        do {
            $message = rtrim(fgets(STDIN),"\r\n");
            socket_write($this->socket, $message);
        } while ($message !== 'выход');
    }
    /**
     * Закрывает соединение и сокет.
     */
    public function closeConnectionAndSocket(): void
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