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
            pcntl_signal_dispatch();
            echo 'Waiting for input...' . PHP_EOL;
            $resource = STDIN;
            do {
                pcntl_signal_dispatch();
                $read = [$resource];
                $write = null;
                $except = null;
            } while (stream_select($read, $write, $except, 0) < 1);
            $message = stream_get_line($resource, 1024, "\n");
            $this->sendMessage($message, $this->socket);
            echo 'Waiting for confirmation...';
            $sockets = $this->waitForSocketEvent([$this->socket]);
            $message = socket_read(current($sockets), 1024);
            echo 'done' . PHP_EOL;
            echo $message . PHP_EOL;
        } while (true);
    }
}
