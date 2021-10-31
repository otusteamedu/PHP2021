<?php

namespace App\Classes\Sockets;

use App\Traits\ConfigurableTrait;

abstract class SocketHandler
{
    protected $socketPath;
    protected $socket;
    protected $connection;

    use ConfigurableTrait;

    public function run()
    {
        try {
            $this->socketPath = $this->config->getValue('socket.path');
            $this->initializeSocket();
            $this->initializeConnection();
            $this->handle();
        } catch (\Exception $e) {
            echo PHP_EOL . $e->getMessage() . PHP_EOL;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }

    protected function initializeSocket(): void
    {
        echo 'Socket initializing...';
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        echo 'done' . PHP_EOL;
    }

    protected function closeConnectionAndSocket(): void
    {
        echo 'Closing connection & socket...';
        if ($this->connection) {
            socket_close($this->connection);
        }
        if ($this->socket) {
            socket_close($this->socket);
        }
        unlink($this->socketPath);
        echo 'done' . PHP_EOL;
    }

    abstract protected function initializeConnection(): void;

    abstract protected function handle(): void;
}
