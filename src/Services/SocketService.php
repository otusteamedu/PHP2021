<?php

declare(strict_types=1);

namespace Sources\Services;

use Sources\Exceptions\SocketException;

class SocketService
{
    const SOCKET = '/var/www/html/temp/chatsocket';
    const READ_LENGTH = 1024;

    private \Socket $socket;

    protected function addSocketError(string $message): string
    {
        return $message . ' ' . socket_strerror(socket_last_error()) . '.';
    }

    public function create(): \Socket
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if ($this->socket === false) {
            throw new SocketException(self::addSocketError('Create socket error.'));
        }

        return $this->socket;
    }

    public function bind(): void
    {
        if (file_exists(self::SOCKET)) {
            unlink(self::SOCKET);
        }

        $bind = socket_bind($this->socket, self::SOCKET);

        if ($bind === false) {
            throw new SocketException(self::addSocketError('Bind socket error.'));
        }
    }

    public function listen(): void
    {
        $listen = socket_listen($this->socket);

        if ($listen === false) {
            throw new SocketException(self::addSocketError('Listen socket error.'));
        }
    }

    public function accept(): \Socket
    {
        $accept = socket_accept($this->socket);

        if ($accept === false) {
            throw new SocketException(self::addSocketError('Accept socket error.'));
        }

        return $accept;
    }

    public function connect(): void
    {
        $connect = socket_connect($this->socket, self::SOCKET);

        if ($connect === false) {
            throw new SocketException(self::addSocketError('Connect socket error.'));
        }
    }

    public function read(?\Socket $socket = null): string
    {
        if (empty($socket)) {
            $socket = $this->socket;
        }

        $read = socket_read($socket, self::READ_LENGTH, PHP_NORMAL_READ);

        if ($read === false) {
            throw new SocketException(self::addSocketError('Read socket error.'));
        }

        return trim($read);
    }

    public function write(string $msg, ?\Socket $socket = null): void
    {
        if (empty($socket)) {
            $socket = $this->socket;
        }

        $write = socket_write($socket, $msg, strlen($msg));

        if ($write === false) {
            throw new SocketException(self::addSocketError('Write socket error.'));
        }
    }

    public function close(?\Socket $socket = null): void
    {
        if (empty($socket)) {
            $socket = $this->socket;
        }

        socket_close($socket);
    }
}