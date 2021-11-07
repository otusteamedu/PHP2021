<?php

namespace App\Client;

use Exception;

class Client
{
    private const SOCKET_PATH = '/var/www/app/app.sock';
    private const EXIT = 'выход';

    /** @var false|resource */
    private $socket;

    public function run()
    {
        try {
            $this->connectToSocket();

            $this->sendMessages();
        } catch (Exception $e) {
            echo sprintf('Error: %s.%s', $e->getMessage(), PHP_EOL);
        } finally {
            $this->closeSocket();
        }
    }

    /**
     * @throws Exception
     */
    private function connectToSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_connect($this->socket, self::SOCKET_PATH)) {
            throw new Exception("Не удалось установить соединение с сокетом");
        }

        echo "Соединение установлено" . PHP_EOL;
        echo $this->getMessage() . PHP_EOL;
    }

    /**
     * Отправление сообщений из консоли до тех пор, пока не введена команда на
     * выход
     *
     * @throws Exception
     */
    private function sendMessages(): void
    {
        do {
            $stdin = fopen('php://stdin', 'r');
            echo 'Введите сообщение: ';
            $message = trim(fgets($stdin));
            $this->sendMessage($message);
            echo $this->getMessage() . PHP_EOL;
        } while ($message != self::EXIT);
    }

    /**
     * @throws Exception
     */
    private function getMessage(): string
    {
        $message = socket_read($this->socket, 1024);
        if ($message === false) {
            throw new Exception("Не удалось принять сообщение");
        }

        return $message;
    }

    /**
     * @throws Exception
     */
    private function sendMessage(string $message): void
    {
        if (socket_write($this->socket, $message, strlen($message)) === false) {
            throw new Exception('Не удалось отправить сообщение');
        }
    }

    private function closeSocket(): void
    {
        if ($this->socket) {
            socket_close($this->socket);
        }
        echo "Соединение закрыто" . PHP_EOL;
    }
}
