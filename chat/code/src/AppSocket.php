<?php

namespace Chat;

use \Socket;
use \Exception;

class AppSocket
{
    private Socket $socket;

    public function __construct(Socket $socket = null)
    {
        $this->socket = $socket ?? $this->create();
    }

    public function create(): Socket
    {
        if (is_bool($socket = socket_create(AF_UNIX, SOCK_STREAM, SOL_SOCKET))) {
            throw new Exception("Не удалось выполнить socket_create(): причина: " . socket_strerror(socket_last_error()) . "\n");
        }

        return $socket;
    }

    public function connect(string $host)
    {
        if (socket_connect($this->socket, $host) === false) {
            throw new Exception("Не удалось выполнить socket_connect(): причина: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }
    }

    public function bind(string $host): void
    {
        if (socket_bind($this->socket, $host) === false) {
            throw new Exception("Не удалось выполнить socket_create(): причина: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }
    }

    public function listen(): void
    {
        if (socket_listen($this->socket, 5) === false) {
            throw new Exception("Не удалось выполнить socket_listen(): причина: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }
    }

    public function accept(): AppSocket
    {
        if (($msgSocket = socket_accept($this->socket)) === false) {
            throw new Exception("Не удалось выполнить socket_accept(): причина: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }

        return new AppSocket($msgSocket);
    }

    public function write(string $message, ): void
    {
        if (socket_write($this->socket, $message) === false) {
            throw new Exception("Не удалось выполнить socket_write(): причина: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }
    }

    public function read(): string
    {
        if (($buf = socket_read($this->socket, 2048, PHP_NORMAL_READ)) === false) {
            throw new Exception("Не удалось выполнить socket_read(): причина: " . socket_strerror(socket_last_error($this->socket)) . "\n");
        }

        return $buf;
    }

    public function close()
    {
        socket_close($this->socket);
    }
}
