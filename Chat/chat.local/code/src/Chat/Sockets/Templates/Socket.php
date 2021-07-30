<?php


namespace Chat\Sockets\Templates;


abstract class Socket
{

    protected $socket;
    protected $acceptedSocket;
    protected $bind;
    protected string $host;
    protected int $port;
    protected int $maxConnection = 3;
    protected int $readingLength = 4096;//bytes

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

    protected function read($socket): ?string
    {
        $buf = socket_read($socket, $this->readingLength);
        if (false === $buf) {
            throw new \Exception("Can't read from a socket (socket_read)");
        }
        $buf = trim($buf);
        if (!$buf) {
            return null;
        }
        return trim($buf);
    }

    protected function write($socket, string $message): void
    {
        socket_write(
            $socket,
            $message,
            strlen($message)
        );
    }

}