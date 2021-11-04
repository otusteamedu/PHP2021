<?php

namespace App\Socket;

use Exception;

class SocketService
{
    /** @var false|resource|\Socket */
    private $socket;

    /** @var false|resource|\Socket */
    private $connection;

    /** @var string $socketPath футь до сокета */
    private string $socketPath;

    public function __construct(string $socketPath)
    {
        $this->socketPath = $socketPath;
    }

    /**
     * Инициализирует сокет.
     *
     * @throws Exception
     */
    public function initializeSocket(): void
    {
        echo "Инициализирую сокет..." . PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (socket_bind($this->socket, $this->socketPath) === false) {
            throw new Exception("Не удалось привязать имя к сокету");
        }

        $result = socket_listen($this->socket);
        if (!$result) {
            throw new Exception("Не удалось начать прослушивать соединение");
        }
        echo "Сокет инициализирован" . PHP_EOL;
    }

    /**
     * Поднимает соединение.
     *
     * @throws Exception
     */
    public function initializeConnection(): void
    {
        echo "Поднимаю соединение..." . PHP_EOL;
        $this->connection = socket_accept($this->socket);
        if (!$this->connection) {
            throw new Exception("Не удалось поднять соединение");
        }
        echo "Соединение поднято" . PHP_EOL;
    }

    public function connectToSocket(): void
    {
        echo "Соединяюсь с сокетом..." . PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (!file_exists($this->socketPath)) {
            throw new Exception("Файл сокета не найден");
        }

        if (!socket_connect($this->socket, $this->socketPath)) {
            throw new Exception("Не удалось установить соединение");
        }
        echo "Соединение установлено" . PHP_EOL;
    }

    public function readMessage(): string
    {
        return socket_read($this->connection ?? $this->socket, 1024);
    }

    /**
     * @param string $message сообщение
     * @throws Exception
     */
    public function writeMessage(string $message): void
    {
        if (false === socket_write($this->connection ?? $this->socket, $message)) {
            throw new Exception('Не получилось записать в сокет');
        }
    }

    public function closeConnection(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }
        echo "Соединение закрыто" . PHP_EOL;
    }

    public function closeSocket(): void
    {
        if ($this->socket) {
            socket_close($this->socket);
        }
        echo "Сокет закрыт" . PHP_EOL;
    }

    public function deleteSocketFile(): void
    {
        if (file_exists($this->socketPath)) {
            unlink($this->socketPath);
        }
        echo "Сокет файл удален" . PHP_EOL;
    }
}
