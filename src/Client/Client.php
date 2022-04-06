<?php

namespace Ivanboriev\SocketChat\Client;

use Ivanboriev\SocketChat\Exceptions\SocketBindException;
use Ivanboriev\SocketChat\Exceptions\SocketListenException;
use Ivanboriev\SocketChat\Exceptions\SocketReadException;
use Ivanboriev\SocketChat\Exceptions\SocketWriteException;
use Ivanboriev\SocketChat\Traits\HasMessage;

class Client
{
    use HasMessage;

    /** @var false|resource|\Socket */
    private $socket;

    /** @var false|resource|\Socket */
    private $connection;

    private array $config;

    /**
     * @throws SocketListenException
     * @throws SocketBindException
     */
    public function run(array $config): void
    {
        $this->config = $config;

        $this->initConnection();
        $this->sendMessages();
        $this->closeConnection();
    }

    /**
     * @throws SocketBindException
     * @throws \Exception
     */
    private function initConnection()
    {
        $this->info("Поднимаю соединение...");

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

        if (!socket_connect($this->socket, $this->config['SOCKET_PATH'])) {
            throw new SocketBindException;
        }

        $this->info('Соединение установлено, введите сообщение...');

    }

    private function sendMessages()
    {
        do {
            $this->send('Введите сообщение: ');

            try {
                $message = trim(fgets(STDIN));

                $this->sendMessage($message);

                $this->send($this->getMessage());
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }


        } while ($message !== $this->config['EXIT_MSG']);

    }

    /**
     * @throws \Exception
     */
    private function sendMessage(string $message): void
    {
        if (socket_write($this->socket, $message, strlen($message)) === false) {
            throw new SocketWriteException;
        }
    }

    /**
     * @throws \Exception
     */
    private function getMessage(): string
    {
        $message = socket_read($this->socket, 1024);
        if ($message === false) {
            throw new SocketReadException;
        }

        return "Ответ от сервера: " . $message;
    }

    private function closeConnection()
    {
        $this->info("Закрываем соединение...");
        socket_close($this->socket);
        $this->info("Соединение закрыто");
    }
}