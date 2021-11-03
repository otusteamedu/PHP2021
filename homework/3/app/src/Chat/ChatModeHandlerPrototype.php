<?php

namespace App\Chat;

use \Exception;
use \Socket;

abstract class ChatModeHandlerPrototype
    implements ChatModeHandlerInterface
{
    protected const SOCKET_PATH = '/var/run/chat.sock';

    /** @var false|resource|Socket */
    protected $socket;

    /** @var false|resource|Socket */
    protected $connection;

    protected function resetSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
    }

    protected function bindSocket(): void
    {
        if (socket_bind($this->socket, self::SOCKET_PATH) === false) {
            throw new Exception("Не удалось привязать имя к сокету");
        }
    }

    protected function initializeSocket(): void
    {
        echo "Инициализирую сокет..." . PHP_EOL;

        $this->resetSocket();

        if ($this->socket === false) {
            throw new Exception('Не удалось создать сокет');
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

        echo "Соединение и сокет закрыты" . PHP_EOL;
    }

    abstract protected function acceptMessages(): void;

    abstract protected function initializeConnection(): void;

    public function run()
    {
        try {
            $this->initializeSocket();
            $this->initializeConnection();
            $this->acceptMessages();
        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }
}
