<?php

declare(strict_types=1);

namespace App\Client;

use App\Socket\MySocket;
/**
 * Клиент.
 */
class Client
{
    /** @var false|resource|\Socket */
    private $socketClass;

    /**
     * Запускает клиент.
     */
    public function runClient()
    {

        $this->socketClass = new MySocket();

        try {

            // Устанавливаем соединение
            $this->socketClass->addConnection();
            // Отправляем сообщение
            $this->socketClass->sendMessages();
        } catch (\Exception $e) {
            // Выводим сообщение об ошибке
            echo $e->getMessage().PHP_EOL;

        } finally {
            // Закрываем соединение и сокет
            $this->socketClass->closeConnectionAndSocket();
        }
    }



}
