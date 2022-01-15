<?php

namespace App\Core\Client;

use App\Core\BaseSocket;
use App\Exceptions\SocketException;
use RuntimeException;

class ClientSocket extends BaseSocket
{
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

            $this->send();
        } finally {
            $this->closeSocket();

            echo "Соединение закрыто" . PHP_EOL;
        }
    }

    /**
     * @return void
     * @throws SocketException
     */
    private function init(): void
    {
        if (!socket_connect($this->socket, $this->path)) {
            throw new SocketException($this->getSocketLastError());
        }

        if (!socket_set_nonblock($this->socket)) {
            throw new SocketException($this->getSocketLastError());
        }
    }

    /**
     * @return void
     * @throws SocketException
     */
    private function send(): void
    {
        while (true) {
            $str = fgets(STDIN);

            if ($str === false) {
                throw new RuntimeException('Ошибка чтения STDIN');
            }

            $this->socketWrite($this->socket, trim($str));

            usleep(100);
            while (true) {
                $msg = $this->socketRead($this->socket);
                if ($msg === '') {
                    break;
                }

                if (!$msg) {
                    break;
                }

                echo $msg . PHP_EOL;
            }

            if ($str === $this->stopPhrase) {
                return;
            }
        }
    }
}
