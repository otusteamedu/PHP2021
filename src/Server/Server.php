<?php

declare(strict_types=1);

namespace App\Server;

/**
 * Сервер.
 */
class Server
{
    private const SOCKET_PATH = './otus-php-sockets.sock';
    /** @var string */
    private $socket_path;

    /** @var false|resource|\Socket */
    private $socket;

    /** @var false|resource|\Socket */
    private $connection;


    public function __construct()
    {
        // Обрабатываем без секций
        $ini_params = parse_ini_file("./config.ini");
        $this->socket_path = './'.$ini_params['socked_path'];
    }


    /**
     * Запускает сервер.
     */
    public function runServer(): void
    {
        try {

            // Инициализируем сокет
            $this->initializeSocket();

            // Инициализируем соединение
            $this->initializeConnection();

            // Начинаем принимать сообщения в бесконечном цикле
            $this->acceptMessages();

        } catch (\Exception $e) {

            // Выводим сообщение об ошибке
            echo $e->getMessage().PHP_EOL;

        } finally {

            // Закрываем соединение и сокет
            $this->closeConnectionAndSocket();

        }
    }

    /**
     * Инициализирует сокет.
     *
     * @throws \Exception
     */
    private function initializeSocket(): void
    {
        echo "Инициализирую сокет...".PHP_EOL;
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (socket_bind($this->socket, $this->socket_path) === false) {
            throw new \Exception("Не удалось привязать имя к сокету");
        }

        $result = socket_listen($this->socket);
        if (!$result) {
            throw new \Exception("Не удалось начать прослушивать соединение");
        }
        echo "Сокет инициализирован".PHP_EOL;
    }

    /**
     * Инициализирует соединение.
     *
     * @throws \Exception
     */
    private function initializeConnection(): void
    {
        echo "Поднимаю соединение...".PHP_EOL;
        $this->connection = socket_accept($this->socket);
        if (!$this->connection) {
            throw new \Exception("Не удалось поднять соединение");
        }
        echo "Соединение поднято".PHP_EOL;
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "выход".
     */
    private function acceptMessages(): void
    {
        echo "Ожидаю сообщения...".PHP_EOL;
        do {
            $message = socket_read($this->connection, 1024);
            echo $message.PHP_EOL;
            // TODO: как отправить подтверждение клиенту?
            $answer = 'Received 24 bytes';
            socket_write($this->connection,$answer,strlen($answer));
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
        unlink($this->socket_path);
        echo "Соединение и сокет закрыты".PHP_EOL;
    }
}