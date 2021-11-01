<?php

namespace App\Classes\Sockets\Client;

use App\Classes\Exceptions\ConnectionStartingErrorException;
use App\Classes\Sockets\SocketHandler;

class Client extends SocketHandler
{
    protected function initializeConnection(): void
    {
        echo 'Connecting to server...';
        $this->connection = socket_connect($this->socket, $this->socketPath);
        if (! $this->connection) {

            throw new ConnectionStartingErrorException();
        }

        echo 'done' . PHP_EOL;
    }

    protected function handle(): void
    {
        do {
            $message = readline('Waiting for input...');
            $this->sendMessage($message, $this->socket);
            echo 'Waiting for confirmation...';
            $message = socket_read($this->socket, 1024);
            echo 'done' . PHP_EOL;
            echo $message . PHP_EOL;
        } while (true);
    }
}
