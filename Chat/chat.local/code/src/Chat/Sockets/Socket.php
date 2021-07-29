<?php


namespace Chat\Sockets;


class Socket
{

    private $socket;
    private $acceptedSocket;
    private $bind;
    private string $host;
    private int $port;
    private int $maxConnection = 3;
    private int $readingLength = 4096;//bytes

    public function __construct(string $host, int $port)
    {
        if (!$host || !$port) {
            throw new \Exception("No host or port passed");
        }

        $this->host = $host;
        $this->port = $port;
    }

    public function create(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if ($this->socket === false) {
            throw new \Exception("Can't create socket");
        }
    }

    public function accept(): void
    {
        $this->acceptedSocket = socket_accept($this->socket);
        if ($this->acceptedSocket === false) {
            throw new \Exception("Can't accept a connection on a socket (socket_accept)");
        }
    }

    public function clearSocketFile(): void
    {
        if (file_exists($this->host)) {
            unlink($this->host);
        }
    }

    public function bindName(): void
    {
        $this->bind = socket_bind($this->socket, $this->host, $this->port);
        if ($this->bind === false) {
            throw new \Exception("Can't bind a name to socket (socket_bind)");
        }
    }

    public function connect(): void
    {
        $this->connect = socket_connect($this->socket, $this->host, $this->port);
        if ($this->connect === false) {
            throw new \Exception("Can't connect to cocket (socket_connect)");
        }
    }

    public function listen(): void
    {
        $this->bind = socket_listen($this->socket, $this->maxConnection);
        if ($this->bind === false) {
            throw new \Exception("Can't listen for a connection on a socket (socket_listen)");
        }
    }

    public function readFromSocket(): ?string
    {
        return $this->read($this->socket);
    }

    public function readFromAcceptedSocket(): ?string
    {
        return $this->read($this->acceptedSocket);
    }

    private function read($socket): ?string
    {
        if (false === ($buf = socket_read($socket, $this->readingLength))) {
            throw new \Exception("Can't read from a socket (socket_read)");
        }
        if (!$buf = trim($buf)) {
            return null;
        }
        return trim($buf);
    }

    public function writeToSocket(string $message): void
    {
        $this->write($this->socket, $message);
    }

    public function writeToAccepted(string $message): void
    {
        $this->write($this->acceptedSocket, $message);
    }

    private function write($socket, string $message): void
    {
        socket_write(
            $socket,
            $message,
            strlen($message)
        );
    }

}