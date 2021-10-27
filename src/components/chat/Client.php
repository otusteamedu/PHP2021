<?php

namespace Project\components\chat;

use Project\components\chat\UserSocket;
use ErrorException;

class Client extends UserSocket
{
    public function run(string $message) : void
    {
        try {
            socket_sendto(
                $this->userSocket,
                $message,
                strlen($message),
                0,
                $this->address,
                0
            );
        } catch (\ErrorException $e) {
            echo $e->getMessage();
        }

    }
}