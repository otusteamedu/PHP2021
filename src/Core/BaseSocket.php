<?php

namespace App\Core;

use App\Exceptions\SocketException;
use InvalidArgumentException;
use Socket;

abstract class BaseSocket
{
    private const
        CONFIG_PATH = 'path',
        CONFIG_BUF_SIZE = 'buf_size',
        CONFIG_STOP_PHRASE = 'stop_phrase';

    /** @var Socket|false */
    protected Socket|false $socket;

    /** @var string */
    protected string $path;

    /** @var string */
    protected string $stopPhrase;

    /** @var int */
    protected int $bufSize;

    /**
     * Запуск сокета
     *
     * @throws SocketException
     */
    public function run(array $config): void
    {
        $this->configure($config);

        $this->createSocket();
    }

    /**
     * @param array $config
     * @return void
     */
    protected function configure(array $config): void
    {
        $errorMsg = 'В конфигурации нет ';

        $this->path = $config[self::CONFIG_PATH]
                      ?? throw new InvalidArgumentException($errorMsg . self::CONFIG_PATH);

        $this->bufSize = $config[self::CONFIG_BUF_SIZE]
                         ?? throw new InvalidArgumentException($errorMsg . self::CONFIG_BUF_SIZE);

        $this->stopPhrase = $config[self::CONFIG_STOP_PHRASE]
                            ?? throw new InvalidArgumentException($errorMsg . self::CONFIG_STOP_PHRASE);
    }

    /**
     * @return string
     */
    protected function getSocketLastError(): string
    {
        return socket_strerror(socket_last_error($this->socket));
    }

    /**
     * @return void
     */
    protected function closeSocket(): void
    {
        if (!empty($this->socket)) {
            socket_close($this->socket);
        }
    }

    /**
     * @return void
     * @throws SocketException
     */
    protected function createSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!$this->socket) {
            throw new SocketException($this->getSocketLastError());
        }
    }

    /**
     * @param Socket $socket
     * @return string
     */
    protected function socketRead(Socket $socket): string
    {
        return trim(socket_read($socket, $this->bufSize));
    }

    /**
     * @param Socket $socket
     * @param string $str
     * @return void
     * @throws SocketException
     */
    protected function socketWrite(Socket $socket, string $str): void
    {
        if (!socket_write($socket, $str, mb_strlen($str))) {
            throw new SocketException($this->getSocketLastError());
        }
    }
}
