<?php

namespace App;

use Exception;

class Client
{
    /** @var false|resource */
    private $socket;

    /** @var false|resource */
    private $socket_path;

    /** @var false|resource */
    private $exit_msg;

    public function run(): void
    {
        try {
            $this->configure();
            $this->connectToSocket();
            $this->sendMessages();
        } catch (Exception $e) {
            printf('Error: %s.%s', $e->getMessage(), PHP_EOL);
        } finally {
            $this->closeSocket();
        }
    }

    private function configure()
    {
        if ($config = parse_ini_file('config.ini')) {
            $this->socket_path = $config['path'];
            $this->exit_msg = $config['exit_msg'];
        } else {
            throw new \Exception('Ошибка конфигурации');
        }
    }

    /**
     * @throws Exception
     */
    private function connectToSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_connect($this->socket, $this->socket_path)) {
            throw new Exception("Не удалось установить соединение с сокетом");
        }

        echo "Соединение установлено" . PHP_EOL;
        echo $this->getMessage() . PHP_EOL;
    }

     /**
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
        } while ($message !== $this->exit_msg);
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