<?php

namespace Chat;

class ApplicationServer
{
    private $config;
    private $socket;
    private $connection;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        try {
            $this->initializeSocket();
            $this->initializeConnection();
            $this->acceptMessages();
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
            throw new \Exception('Не получислось созать сокет');
        }

        if (socket_bind($this->socket, $this->config['pathSocket']) === false) {
            throw new \Exception('Не удалось привязать сокет');
        }

        if (!socket_listen($this->socket)) {
            throw new \Exception('Не удалось начать прослушивание соединения');
        }

        echo 'Сокет инициализирован' . PHP_EOL;
    }

    private function initializeConnection(): void
    {
        $this->connection = socket_accept($this->socket);

        if (!$this->connection) {
            throw new \Exception('Не удалось иницаилизировать соединение');
        }

        echo 'Соединение инициализировать' . PHP_EOL;

        $msg = 'Соединение установлено';
        socket_write($this->connection, $msg, strlen($msg));
    }

    private function acceptMessages(): void
    {
        echo 'Ожидание сообщения...' . PHP_EOL;

        do {
            $msgReseived = socket_read($this->connection, 1024);
            echo "Полученно: $msgReseived";

            if (trim($msgReseived) == $this->config['endConnectionMessage']) {
                $msgSent = 'Соеднинеие закрыто';
                socket_write($this->connection, $msgSent);

                break;
            }
            $msgSent = 'Полученно ' . mb_strlen($msgReseived) . ' байт';
            socket_write($this->connection, $msgSent);
        } while (true);
    }

    private function closeSocket(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }

        if ($this->socket) {
            socket_close($this->socket);
        }

        unlink($this->config['pathSocket']);
        echo 'Соединение и сокеты закрыты успешно' . PHP_EOL;
    }
}
