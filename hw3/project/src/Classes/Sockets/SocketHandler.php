<?php

namespace App\Classes\Sockets;

use App\Classes\Exceptions\ForkingErrorException;
use App\Classes\Exceptions\SocketWriteErrorException;
use App\Classes\Exceptions\TerminatedException;
use App\Traits\ConfigurableTrait;

abstract class SocketHandler
{
    protected $socketPath;
    protected $socket;
    protected $connection;

    use ConfigurableTrait;

    public function run(): void
    {
        try {
            $this->socketPath = $this->config->getValue('socket.path');
            $this->initializeSignalHandler();
            $this->initializeSocket();
            $this->initializeConnection();
            $this->handle();
        } catch (\Exception $e) {
            echo PHP_EOL . $e->getMessage() . PHP_EOL;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }

    protected function initializeSignalHandler(): void
    {
        $signals = [
            SIGINT,
            SIGHUP,
            SIGTERM,
            SIGQUIT,
            SIGABRT,
        ];

        foreach ($signals as $signal) {
            pcntl_signal(
                $signal,
                function ($signal, $signalInfo) {

                    throw new TerminatedException();
                }
            );
        }
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

    protected function initializeSocket(): void
    {
        echo 'Socket initializing...';
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        echo 'done' . PHP_EOL;
    }

    protected function sendMessage(string $message, $socket): void
    {
        if (socket_write($socket, $message, strlen($message)) === false) {

            throw new SocketWriteErrorException();
        }
    }

    protected function waitForSocketEvent($sockets)
    {
        do {
            pcntl_signal_dispatch();
            $read = $sockets;
            $write = null;
            $except = null;
        } while (socket_select($read, $write, $except, 0) < 1);

        return $read;
    }

    abstract protected function initializeConnection(): void;

    abstract protected function handle(): void;
}
