<?php

declare(strict_types=1);

namespace App\Server;

use App\App;
use App\Core\Socket;
use Exception;

/**
 * Сервер.
 */
class Server extends Socket
{
    /**
     * Инициализирует сокет.
     *
     * @throws Exception
     */
    protected function initializeSocket(): void
    {
        echo "Пытаюсь инициализировать сокет...".PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (!socket_bind($this->socket, App::SOCKET_PATH)) {
            throw new Exception("Не удалось привязать имя к сокету:(");
        }

        if (!socket_listen($this->socket)) {
            throw new Exception("Не удалось начать прослушивать соединение:(");
        }

        echo "Сокет инициализирован!".PHP_EOL;
    }

    /**
     * Поднимает соединение.
     *
     * @throws Exception
     */
    protected function initializeConnection(): void
    {
        echo "Пытаюсь поднять соединение...".PHP_EOL;

        $this->connection = socket_accept($this->socket);

        if (!$this->connection) {
            throw new Exception("Не удалось поднять соединение");
        }

        echo "Соединение поднято!".PHP_EOL;
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "leave".
     */
    protected function makeMessages(): void
    {
        echo "Ожидаю сообщения...".PHP_EOL;

        do {
            $message = socket_read($this->connection, 1024);

            if ($message) {
                $msg = 'Сообщение доставлено!';

                if ($message === 'leave') {
                    $msg = 'До встречи!';
                }

                socket_write($this->connection, $msg.PHP_EOL);

                echo $message.PHP_EOL;
            }
        } while ($message !== 'leave');
    }

    /**
     * Запускает сервер.
     */
    public function run()
    {
        try {
            $this->initializeSocket();
            $this->initializeConnection();
            $this->makeMessages();
        } catch (Exception $e) {
            echo $e->getMessage().PHP_EOL;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }
}
