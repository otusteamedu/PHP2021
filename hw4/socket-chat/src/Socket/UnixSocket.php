<?php

namespace App\Socket;

class UnixSocket extends Socket
{
    /**
     * @throws SocketException
     */
    public function __construct()
    {
        $socket = \socket_create(AF_UNIX, SOCK_STREAM, 0);

        if ($socket === false) {
            $this->throwSocketException();
        }

        parent::__construct($socket);
    }
}
