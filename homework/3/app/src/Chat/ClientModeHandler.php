<?php

namespace App\Chat;

use Exception;

class ClientModeHandler extends ChatModeHandlerPrototype
{
    protected function initializeConnection(): void
    {
        echo "Подключаюсь к сокету..." . PHP_EOL;

        $connectResult = socket_connect($this->socket, self::SOCKET_PATH);

        if ($connectResult === false) {
            throw new Exception("Не удалось поднять соединение");
        }

        echo "Соединение установлено" . PHP_EOL;
    }

    protected function acceptMessages(): void
    {
        echo 'Готов к отправке сообщений: ' . PHP_EOL;

        do {
            $message = readline('Сообщение: ');

            if (socket_write($this->socket, $message, 1024) === false) {
                echo 'Не удалось отправить сообщение' . PHP_EOL;
            } else {
                if ($response = socket_read($this->socket, 1024)) {
                    echo $response . PHP_EOL;
                }
            }
        } while (mb_strtolower($message, 'UTF-8') !== 'выход');
    }

    public function run()
    {
        echo 'Запущен в режиме "Клиент"' . PHP_EOL;

        parent::run();
    }
}
