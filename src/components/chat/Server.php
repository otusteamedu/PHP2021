<?php

namespace Project\components\chat;

use Project\components\chat\UserSocket;
use ErrorException;

class Server extends UserSocket
{
    public function run() : void
    {
        try {
            $isConnected = socket_bind($this->userSocket, $this->address);
            if (!$isConnected) {
                throw new ErrorException('Bind error!');
            }

            while (true) {
                socket_recvfrom($this->userSocket, $data, 2048, MSG_WAITALL, $source);

                if (!empty($data)) {
                    echo $data . PHP_EOL;
                }

                sleep(1);
            }
        } catch (ErrorException $e) {
            var_dump($e->getMessage());
        }
    }

    public function __destruct()
    {
        socket_close($this->userSocket);
        unlink($this->address);
    }
}
