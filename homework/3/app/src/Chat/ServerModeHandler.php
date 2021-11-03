<?php

namespace App\Chat;

use Exception;

class ServerModeHandler extends ChatModeHandlerPrototype
{
    protected function initializeSocket(): void
    {
        parent::initializeSocket();

        $this->bindSocket();

        $result = socket_listen($this->socket);

        if (! $result) {
            throw new Exception("Не удалось начать прослушивать соединение");
        }
    }

    protected function initializeConnection(): void
    {
        echo "Поднимаю соединение..." . PHP_EOL;

        $this->connection = socket_accept($this->socket);

        if (! $this->connection) {
            throw new \Exception("Не удалось поднять соединение");
        }

        echo "Соединение поднято" . PHP_EOL;
    }

    protected function acceptMessages(): void
    {
        echo "Ожидаю сообщения..." . PHP_EOL;

        do {
            $message = socket_read($this->connection, 1024);

            if (strlen($message) > 0) {
                echo $message . PHP_EOL;
                socket_write($this->connection, sprintf('Получено сообщение: %s байт', strlen($message)) . PHP_EOL);
            }
        } while (mb_strtolower($message, 'UTF-8') !== 'выход');
    }

    public function run()
    {
        echo 'Запущен в режиме "Сервер"' . PHP_EOL;

        parent::run();
    }
}
