<?php

declare(strict_types=1);

namespace App\Client;

use App\App;
use App\Core\Socket;
use Exception;

/**
 * Клиент.
 */
class Client extends Socket
{
    /**
     * Инициализирует соединение
     *
     * @throws Exception
     */
    protected function initializeConnection()
    {
        echo "Пытаюсь подключиться к чату...".PHP_EOL;

        if (!file_exists(App::SOCKET_PATH)) {
            throw new Exception('Такого сокета не существует :(');
        }

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (socket_connect($this->socket, App::SOCKET_PATH)) {
            echo 'Вы успешно подключились к чату!'.PHP_EOL;
        }
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "leave".
     *
     * @throws Exception
     */
    protected function makeMessages()
    {
        do {
            $message = readline('');
            socket_write($this->socket, $message);

            $input = socket_read($this->socket, 1024);
            echo $input;
        } while ($message !== 'leave' && $input);
    }


    /**
     *
     * Запускает клиента
     *
     */
    public function run()
    {
        try {
            $this->initializeConnection();
            $this->makeMessages();
        } catch (Exception $e) {
            echo $e->getMessage().PHP_EOL;
        }
    }
}
