<?php

namespace Chat;

class ApplicationServer
{
    private $config;
    private $socket;
    private $connection;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        try {
            $this->initializeSocket();
            $this->initializeConnection();
            $this->acceptMessages();
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        } finally {
            $this->closeSocket();
        }
    }

    private function initializeSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if(!$this->socket) {
            throw new \Exception('Can\'t create socket');
        }

        if (socket_bind($this->socket, $this->config['pathSocket']) === false) {
            throw new \Exception('Can\'t bind socket');
        }

        if (!socket_listen($this->socket)) {
            throw new \Exception('Failed to start listening for connection');
        }
        echo 'Socket initialized' . PHP_EOL;
    }

    private function initializeConnection(): void
    {
        $this->connection = socket_accept($this->socket);
        if (!$this->connection) {
            throw new \Exception('Can\'t initialize connection');
        }
        echo 'Connection initialized' . PHP_EOL;

        $msg = 'Connection established';
        socket_write($this->connection, $msg, strlen($msg));
    }

    private function acceptMessages(): void
    {
        echo 'Waiting for a message...' . PHP_EOL;
        do {
            $msgReseived = socket_read($this->connection, 1024);
            echo 'Received: ' . $msgReseived;
            if (trim($msgReseived) == $this->config['endConnectionMessage']) {
                $msgSent = 'Connection closed';
                socket_write($this->connection, $msgSent);
                break;
            }
            $msgSent = 'Received ' . mb_strlen($msgReseived) . ' byte';
            socket_write($this->connection, $msgSent);
        } while (true);
    }

    private function closeSocket(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }
        if ($this->socket) {
            socket_close($this->socket);
        }
        unlink($this->config['pathSocket']);
        echo 'Connection and Socket closed successfully' . PHP_EOL;
    }
}
