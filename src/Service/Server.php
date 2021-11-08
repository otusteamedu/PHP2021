<?php

namespace App\Service;

use Exception;

class Server implements Service
{
    /** @var false|resource */
    private $socket;

    /** @var false|resource */
    private $connection;

    public function run(): void
    {
        try {
            $this->initializeSocket();
            $this->initializeConnection();

            $this->acceptMessages();
        } catch (Exception $e) {
            printf('Error: %s.%s', $e->getMessage(), PHP_EOL);
        } finally {
            $this->closeConnectionAndSocket();
        }
    }

    /**
     * @throws Exception
     */
    private function initializeSocket(): void
    {
        echo 'Инициализирую сокет...' . PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (socket_bind($this->socket, self::SOCKET_PATH) === false) {
            throw new Exception('Не удалось привязать имя к сокету');
        }

        if (!socket_listen($this->socket)) {
            throw new Exception('Не удалось начать прослушивать соединение');
        }

        echo 'Сокет инициализирован' . PHP_EOL;
    }

    /**
     * @throws Exception
     */
    private function initializeConnection(): void
    {
        echo 'Поднимаю соединение...' . PHP_EOL;
        $this->connection = socket_accept($this->socket);

        if (!$this->connection) {
            throw new Exception('Не удалось поднять соединение');
        }

        echo 'Соединение поднято' . PHP_EOL;
        $this->sendMessage('Сервер готов принимать сообщения');
    }

    /**
     * Прием сообщений до тех пор, пока не получена команда на выход
     *
     * @throws Exception
     */
    private function acceptMessages(): void
    {
        echo 'Ожидаю сообщения...' . PHP_EOL;
        do {
            $message = $this->getMessage();
            echo $message . PHP_EOL;
            $this->sendMessage(sprintf('Принято %s байт', strlen($message)));
        } while ($message !== self::EXIT);
    }

    /**
     * @throws Exception
     */
    private function getMessage(): string
    {
        $message = socket_read($this->connection, 1024);
        if ($message === false) {
            throw new Exception("Не удалось принять сообщение");
        }

        return $message;
    }

    /**
     * @throws Exception
     */
    private function sendMessage(string $message): void
    {
        if (socket_write($this->connection, $message, strlen($message))
            === false
        ) {
            throw new Exception('Не удалось отправить сообщение');
        }
    }

    private function closeConnectionAndSocket(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }

        if ($this->socket) {
            socket_close($this->socket);
        }

        unlink(self::SOCKET_PATH);
        echo 'Соединение и сокет закрыты' . PHP_EOL;
    }
}
