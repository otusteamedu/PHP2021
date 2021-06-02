<?php

namespace App\Socket;

use Exception;

class Socket
{
    protected $socket;
    protected $socketFile;
    protected $socketConnect;
    protected $socketMaxConn;
    protected $socketAccepted;

    public function __construct(string $socketFile, int $socketMaxConn = 5)
    {
        $this->socketFile = $socketFile;
        $this->socketMaxConn = $socketMaxConn;
    }

    public function create()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if ($this->socket === false) {
            throw new Exception("Failed to create socket");
        }
    }

    public function bind()
    {
        if (socket_bind($this->socket, $this->socketFile) === false) {
            throw new Exception("Failed to set address to socket");
        }
    }

    public function connect()
    {
        if (false === $this->socketConnect = socket_connect($this->socket, $this->socketFile)) {
            throw new Exception("Failed to connect to socket");
        }
    }

    public function write(string $message): void
    {
        $this->writeToSocket($this->socket, $message);
    }

    public function writeToAccepted(string $message): void
    {
        $this->writeToSocket($this->socketAccepted, $message);
    }

    private function writeToSocket($socket, string $message): void
    {
        socket_write(
            $socket,
            $message,
            strlen($message)
        );
    }

    public function read(): ?string
    {
        return $this->readFromSocket($this->socket);
    }

    public function readFromAccepted()
    {
        return $this->readFromSocket($this->socketAccepted);
    }

    private function readFromSocket($socket): ?string
    {
        if (false === ($buf = socket_read($socket, 1024))) {
            throw new Exception("Failed socket_read()");
        }
        if (!$buf = trim($buf)) {
            return null;
        }
        return trim($buf);
    }

    public function listen()
    {
        $listen = socket_listen($this->socket, $this->socketMaxConn);
        if (!$listen) {
            throw new Exception("Failed to connect to socket");
        }
    }

    public function accept()
    {
        $this->socketAccepted = socket_accept($this->socket);
        if (!$this->socketAccepted) {
            throw new Exception("Failed to connect to socket");
        }
    }

    public function close(): void
    {
        if (!$this->socket) {
            return;
        }
        socket_close($this->socket);
    }


    public function clearOldSocket(): void
    {
        if (file_exists($this->socketFile)) {
            unlink($this->socketFile);
        }
    }
}
