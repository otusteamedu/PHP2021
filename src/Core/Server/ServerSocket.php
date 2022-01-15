<?php

namespace App\Core\Server;

use App\Core\BaseSocket;
use App\Exceptions\SocketException;
use Socket;

class ServerSocket extends BaseSocket
{
    /** @var Socket|false */
    private Socket|false $socketConnect;

    /**
     * @param array $config
     * @return void
     * @throws SocketException
     */
    public function run(array $config): void
    {
        try {
            parent::run($config);

            $this->init();

            $this->listen();
        } finally {
            $this->closeSocket();

            if (!empty($this->socketConnect)) {
                socket_close($this->socketConnect);
            }

            unlink($this->path);

            echo "Соединение закрыто" . PHP_EOL;
        }
    }

    /**
     * @return void
     * @throws SocketException
     */
    private function init(): void
    {
        if (!socket_bind($this->socket, $this->path)) {
            throw new SocketException($this->getSocketLastError());
        }

        if (!socket_listen($this->socket)) {
            throw new SocketException($this->getSocketLastError());
        }
    }

    /**
     * @return void
     * @throws SocketException
     */
    private function listen(): void
    {
        while (true) {
            $this->socketConnect = socket_accept($this->socket);
            if (!$this->socketConnect) {
                throw new SocketException($this->getSocketLastError());
            }

            while (true) {
                $msg = $this->socketRead($this->socketConnect);

                if ($msg === '') {
                    break;
                }

                if (!$msg) {
                    throw new SocketException($this->getSocketLastError());
                }

                if ($msg === $this->stopPhrase) {
                    return;
                }

                $data = "Received " . mb_strlen($msg) . " bytes";

                $this->socketWrite($this->socketConnect, $data);

                echo $msg . PHP_EOL;
            }
        }
    }
}
