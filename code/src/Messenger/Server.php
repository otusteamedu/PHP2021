<?php

declare(strict_types=1);

namespace Vshepelev\App\Messenger;

use Vshepelev\App\Helpers\Str;
use Vshepelev\App\Helpers\Console;

class Server
{
    private const CMD_EXIT = '!выход';
    private const CMD_MSG_COUNT = '!количество';
    private const SHUTDOWN_SIGNAL = '!завершение работы';

    /** @var false|resource */
    private $socket;

    /** @var false|resource */
    private $connection;
    private int $messagesCount = 0;

    private string $unixSocketPath;
    private int $maxMessageLength;

    public function __construct(string $socketPath, int $messageLength)
    {
        $this->unixSocketPath = $socketPath;
        $this->maxMessageLength = $messageLength;
    }

    /**
     * @throws MessengerException
     */
    public function start(): void
    {
        $this->createSocket();
        $this->createConnection();

        $this->handleMessaging();

        $this->closeServer();
    }

    /**
     * @throws MessengerException
     */
    private function createSocket(): void
    {
        Console::info('Инициализация UNIX-сокета...');

        unlink($this->unixSocketPath);
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_bind($this->socket, $this->unixSocketPath)) {
            throw new MessengerException('Не удалось привязать имя к сокету.');
        }

        if (!socket_listen($this->socket)) {
            throw new MessengerException('Не удалось начать прослушивать соединение.');
        }
    }

    /**
     * @throws MessengerException
     */
    private function createConnection(): void
    {
        Console::info('Создание соединения...');
        Console::info('Ожидание клиента...');

        if (!$this->connection = socket_accept($this->socket)) {
            throw new MessengerException('Не удалось создать соединение');
        }
    }

    private function closeServer(): void
    {
        Console::info('Закрываем соединение...');

        socket_close($this->connection);
        socket_close($this->socket);
        unlink($this->unixSocketPath);

        Console::info('Спасибо за использование!');
    }

    private function handleMessaging(): void
    {
        Console::info('Ожидание сообщений клиента...' . PHP_EOL);

        do {
            if ($message = $this->receive()) {
                if ($this->isExitCommand($message)) {
                    $response = self::SHUTDOWN_SIGNAL;
                } elseif ($this->isMessageCountCommand($message)) {
                    $response = "Сервер получил сообщений: {$this->messagesCount}";
                } else {
                    Console::line($message);
                    $this->messagesCount++;
                    $response = 'Получено байт: ' . strlen($message);
                }

                $this->send($response);
            }
        } while (!$this->isExitCommand($message));

        Console::line();
    }

    private function receive(): string
    {
        return socket_read($this->connection, $this->maxMessageLength);
    }

    private function send(string $message): void
    {
        socket_write($this->connection, $message);
    }

    private function isExitCommand(string $message): bool
    {
        return Str::contains($message, self::CMD_EXIT);
    }

    private function isMessageCountCommand(string $message): bool
    {
        return Str::contains($message, self::CMD_MSG_COUNT);
    }
}
