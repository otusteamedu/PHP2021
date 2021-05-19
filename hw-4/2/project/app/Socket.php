<?php

namespace App;

use App\Exceptions\CanNotCreateSocketException;
use App\Exceptions\SocketsException;

class Socket
{
    private $socket;
    private $acceptedSocket;
    private $connect;
    private $bind;
    private $host;
    private $port;
    private $maxConnections = 5;

    public function __construct($host, $port)
    {
        if (!$host) {
            throw new CanNotCreateSocketException('Host is required');
        }
        if (!$port) {
            throw new CanNotCreateSocketException('Port is required');
        }

        $this->host = $host;
        $this->port = $port;
    }

    public function write($message)
    {
        $this->writeToSocket($this->socket, $message);
    }

    public function writeToAccepted($message)
    {
        $this->writeToSocket($this->acceptedSocket, $message);
    }

    public function clearOldSocket()
    {
        if (file_exists($this->host)) {
            unlink($this->host);
        }
    }

    public function create()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if ($this->socket === false) {
            throw new CanNotCreateSocketException();
        }
    }

    public function accept()
    {
        $this->acceptedSocket = socket_accept($this->socket);
        if ($this->acceptedSocket === false) {
            throw new SocketsException();
        }
    }

    public function read()
    {
        return $this->readFromSocket($this->socket);
    }

    public function readFromAccepted()
    {
        return $this->readFromSocket($this->acceptedSocket);
    }

    public function bind()
    {
        $this->bind = socket_bind($this->socket, $this->host, $this->port);
        if ($this->bind === false) {
            throw new CanNotCreateSocketException('Can not bind socked');
        }
    }

    public function connect()
    {
        $this->connect = socket_connect($this->socket, $this->host, $this->port);
        if ($this->connect === false) {
            throw new CanNotCreateSocketException('Can not connect to socket. Is server running?');
        }
    }

    public function listen()
    {
        $this->bind = socket_listen($this->socket, $this->maxConnections);
        if ($this->bind === false) {
            throw new CanNotCreateSocketException();
        }
    }

    public function close()
    {
        if (!$this->socket) {
            return;
        }
        socket_close($this->socket);
    }

    private function writeToSocket($socket, $message)
    {
        socket_write(
            $socket,
            $message,
            strlen($message)
        );
    }

    private function readFromSocket($socket)
    {
        if (false === ($buf = socket_read($socket, 1024))) {
            throw new SocketsException();
        }
        if (!$buf = trim($buf)) {
            return null;
        }
        return trim($buf);
    }
}