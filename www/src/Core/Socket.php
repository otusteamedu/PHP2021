<?php

declare(strict_types=1);

namespace App\Core;

use App\App;
use Exception;

abstract class Socket
{

    protected $socket;
    protected $connection;

    /**
     * Инициализирует сокет.
     *
     * @throws Exception
     */
    protected function initializeSocket(): void
    {
    }

    /**
     * Инициализирует соединение.
     *
     * @throws \Exception
     */
    protected function initializeConnection()
    {
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "leave".
     */
    protected function makeMessages()
    {
    }

    /**
     * Закрывает соединение и сокет.
     */
    protected function closeConnectionAndSocket(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }
        if ($this->socket) {
            socket_close($this->socket);
        }

        unlink(App::SOCKET_PATH);

        echo "Соединение и сокет закрыты.".PHP_EOL;
    }


    /**
     * Запускает
     */
    public function run()
    {
    }
}
