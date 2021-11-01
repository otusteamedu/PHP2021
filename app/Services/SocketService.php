<?php declare(strict_types=1);

namespace App\Services;

use App\Constants\Socket;

class SocketService
{
    private $socket;

    private $connection;

    public function initSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
    }

    public function listen(): void
    {
        if (!socket_bind($this->socket, Socket::PATH)) {
            throw new \Exception("Name socket did not bind");
        }

        if (!socket_listen($this->socket)) {
            throw new \Exception("Listen socket did not start");
        }
    }

    public function connect()
    {
        if (!socket_connect($this->socket, Socket::PATH)) {
            throw new \Exception("Connect was failed");
        }
    }

    public function initAccept(): void
    {
        $this->connection = socket_accept($this->socket);

        if (!$this->connection) {
            throw new \Exception("Connection socket did not start");
        }
    }

    public function getMessage(): string
    {
        $message = socket_read($this->connection ?? $this->socket, 1024);

        if ($message === false) {
            throw new \Exception('System did not get message');
        }

        return trim($message);
    }

    public function sendMessage(string $message): void
    {
        socket_write($this->connection ?? $this->socket, $message, strlen($message));
    }

    public function close(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }

        if ($this->socket) {
            socket_close($this->socket);
        }

        if (file_exists(Socket::PATH)) {
            unlink(Socket::PATH);
        }
    }
}