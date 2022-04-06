<?php
declare(strict_types=1);

namespace Ivanboriev\SocketChat\Server;

use Ivanboriev\SocketChat\Exceptions\ErrorStartingServerException;
use Ivanboriev\SocketChat\Exceptions\SocketBindException;
use Ivanboriev\SocketChat\Exceptions\SocketListenException;
use Ivanboriev\SocketChat\Traits\HasMessage;

class Server
{
    use HasMessage;

    /** @var false|resource|\Socket */
    private $socket;

    /** @var false|resource|\Socket */
    private $connection;

    private array $config;


    public function run(array $config): void
    {
        $this->config = $config;

        try {

            // Инициализируем сокет
            $this->initializeSocket();

            // Инициализируем соединение
            $this->initializeConnection();

            // Начинаем принимать сообщения в бесконечном цикле
            $this->acceptMessages();


        } catch (\Exception $e) {

            $this->error($e->getMessage());

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
        $this->info("Инициализирую сокет...");

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (socket_bind($this->socket, $this->config['SOCKET_PATH']) === false) {
            throw new SocketBindException;
        }

        if (!socket_listen($this->socket)) {
            throw new SocketListenException;
        }

        $this->info("Сокет инициализирован");
    }

    /**
     * Инициализирует соединение.
     *
     * @throws \Exception
     */
    private function initializeConnection(): void
    {
        $this->info("Поднимаю соединение...");

        $this->connection = socket_accept($this->socket);

        if (!$this->connection) {
            throw new SocketBindException;
        }

        $this->info("Соединение поднято");
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку "выход".
     */
    private function acceptMessages(): void
    {
        $this->info("Ожидаю сообщения...");

        do {
            $message = socket_read($this->connection, 1024);

            $this->send($message);

            socket_write($this->connection, "Получено: " . strlen($message) . " байт");

        } while ($message !== $this->config['EXIT_MSG']);
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

        unlink($this->config['SOCKET_PATH']);

        $this->info("Соединение и сокет закрыты");
    }

}
