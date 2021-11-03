<?php

declare(strict_types=1);
namespace App\Client;


class Client
{
    private const SOCKET_PATH = '/tmp/otus-php-sockets8.sock';

    /** @var false|resource|\Socket */
    private $socket;

    /** @var false|resource|\Socket */
    private $connection;

    /**
     * @throws Exception
     */
    public function runClient()
    {
        try {

            // Устанавливаем соединение
            $this->addConnection();
            // Отправляем сообщение
            $this->sendMessages();
        } catch (\Exception $e) {
            // Выводим сообщение об ошибке
            echo $e->getMessage().PHP_EOL;

        } finally {
            // Закрываем соединение и сокет
            $this->closeConnectionAndSocket();
        }
    }


    /**
     * Инициализирует соединение.
     *
     * @throws \Exception
     */
    private function addConnection(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        echo "Создание сокета...".PHP_EOL;
        $this->connection = socket_connect( $this->socket, self::SOCKET_PATH );;
        if (!$this->connection) {
            throw new \Exception("Не удалось создать сокет");
        }
        echo "Сокет создан".PHP_EOL;
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "выход".
     */
    private function sendMessages(): void
    {
        echo "Отправляю сообщение...".PHP_EOL;

        do {
            $message = fgets(STDIN);
            socket_write($this->socket, $message);
        } while ($message !== 'выход');
    }
    /**
     * Закрывает соединение и сокет.
     */
    private function closeConnectionAndSocket(): void
    {
        if ($this->connection) {
            socket_close($this->connection);
        }
        if ($this->socket) {
            socket_close($this->socket);
        }
        unlink(self::SOCKET_PATH);
        echo "Соединение и сокет закрыты".PHP_EOL;
    }
}
