<?php

namespace Chat;

class ApplicationClient
{
    private $config;
    private $socket;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        try {
            $this->initializeSocket();
            $this->sendMessages();
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        } finally {
            $this->closeSocket();
        }
    }

    private function initializeSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (!$this->socket) {
            throw new \Exception('Неудачная попытка инициализировать сокет');
        }

        if (socket_connect($this->socket, $this->config['pathSocket']) === false) {
            throw new \Exception('Не удалось инициализировать сокет');
        }
    }

    private function sendMessages(): void
    {
        do {
            echo 'Ответ сервера: ';
            $msgReceived = socket_read($this->socket, 1024);
            echo $msgReceived . PHP_EOL;
            $msgSent = fgets(STDIN);
            socket_write($this->socket, $msgSent, strlen($msgSent));

            if (trim($msgSent) == $this->config['endConnectionMessage']) {
                $msgReceived = socket_read($this->socket, 1024);
                echo $msgReceived . PHP_EOL;

                break;
            }
        } while (true);
    }

    private function closeSocket(): void
    {
        if ($this->socket) {
            socket_close($this->socket);
        }

        echo 'Сокет успешно закрыт' . PHP_EOL;
    }
}
