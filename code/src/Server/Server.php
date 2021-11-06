<?php

declare(strict_types=1);

namespace App\Server;

use App\Socket\MySocket;
use Exception;

/**
 * Сервер.
 */
class Server
{
    private $socketClass;

    /**
     * Запускает сервер.
     */
    public function runServer()
    {
        $this->socketClass = new MySocket();

        try {

            // Инициализируем сокет
            $this->socketClass->initializeSocket();

            // Инициализируем соединение
            $this->socketClass->initializeConnection();

            // Начинаем принимать сообщения в бесконечном цикле
            $this->socketClass->acceptMessages();

        } catch (\Exception $e) {

            // Выводим сообщение об ошибке
            echo $e->getMessage().PHP_EOL;

        } finally {

            // Закрываем соединение и сокет
            $this->socketClass->closeConnectionAndSocket();

        }
    }
}
