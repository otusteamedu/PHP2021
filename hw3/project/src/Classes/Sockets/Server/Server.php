<?php

namespace App\Classes\Sockets\Server;

use App\Classes\Exceptions\ConnectionStartingErrorException;
use App\Classes\Exceptions\SocketBindingErrorException;
use App\Classes\Exceptions\SocketListeningErrorException;
use App\Classes\Sockets\SocketHandler;

class Server extends SocketHandler
{
    protected function initializeConnection(): void
    {
        echo 'Socket binding...';
        if (socket_bind($this->socket, $this->socketPath) === false) {

            throw new SocketBindingErrorException();
        }
        echo 'done' . PHP_EOL;

        echo 'Starting socket listening...';
        if (! socket_listen($this->socket)) {

            throw new SocketListeningErrorException();
        }
        echo 'done' . PHP_EOL;

        echo 'Waiting for connection...' . PHP_EOL;
        $this->connection = socket_accept($this->socket);
        if (! $this->connection) {

            throw new ConnectionStartingErrorException();
        }

        echo 'Connection accepted' . PHP_EOL;
    }

    protected function handle(): void
    {
        echo 'Waiting for messages...' . PHP_EOL;
        do {
            $message = socket_read($this->connection, 1024);
            echo $message . PHP_EOL;
            $this->sendMessage('Received ' . strlen($message) . ' bytes', $this->connection);
        } while (true);
    }
}
