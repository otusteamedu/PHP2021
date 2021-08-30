<?php

namespace Project\components\chat;

use Socket;
use ErrorException;

class UserSocket
{
    protected Socket $userSocket;
    protected string $address;

    public function __construct(array $config)
    {
        $this->create($config);
    }

    public function __destruct()
    {
        socket_close($this->userSocket);
    }

    public function create(array $config): void
    {
        $this->userSocket = socket_create(
            AF_UNIX,
            SOCK_DGRAM,
            0
        );
        $this->address = $config['address'] ?? '/tmp/chat.sock';
    }
}