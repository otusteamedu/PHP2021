<?php

declare(strict_types=1);

namespace App\Client;

/**
 * Клиент.
 */
class Client
{
    private const SOCKET_PATH = './otus-php-sockets.sock';

    /** @var false|resource|\Socket */
    private $socket;

    /** @var false|resource|\Socket */
    private $connection;

    /**
     * Запускает сервер.
     */
    public function runClient()
    {
        try {

            // Инициализируем сокет
            $this->initializeSocket();

            // Подключаемся к серверу
            $this->connectionServer();

            // Отправляем сообщение
            $this->sendMessages();

        } catch (\Exception $e) {

            // Выводим сообщение об ошибке
            echo $e->getMessage().PHP_EOL;

        } finally {

            // Закрываем соединение и сокет

        }
    }

    /**
     * Инициализируем сокет.
     *
     * @throws \Exception
     */
    private function initializeSocket(): void
    {
        echo "Инициализирую сокет...".PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        echo "Сокет инициализирован".PHP_EOL;
    }

    /**
     * Подключаемся к серверу.
     *
     * @throws \Exception
     */
    private function connectionServer(): void
    {
        echo "Подключаюсь к серверу..".PHP_EOL;
        $this->connection = socket_connect($this->socket, self::SOCKET_PATH);
        if (!$this->connection) {
            throw new \Exception("Не удалось подключиться к серверу");
        }
        echo "Подключились ".PHP_EOL;
    }

    /**
     * Отправляет сообщение.
     */
    private function sendMessages(): void
    {

        $message = '';
        do {
            echo("Отправьте сообщение серверу\n");
            $message = '';
            while(true)
            {
                $strChar = stream_get_contents(STDIN, 1);
                if($strChar===chr(10)) {
                    break;
                }
                $message.=$strChar;
            }          
            if(socket_write($this->socket,$message,strlen($message)) === false) {
                throw new \Exception("Не удалось отправить сообщение серверу");
            }
            else {
                $read=socket_read($this->socket,1024);
                echo $read.PHP_EOL;
            }
        } while ($message !== 'выход');
        $this->closeConnectionAndSocket();
    }

    /**
     * Закрывает соединение и сокет.
     */
    private function closeConnectionAndSocket(): void
    {
        // if ($this->connection) {
        //     socket_close($this->connection);
        // }
        if ($this->socket) {
            socket_close($this->socket);
        }
        echo "Соединение и сокет закрыты".PHP_EOL;
    }

}