<?php

declare(strict_types=1);

namespace Vshepelev\App\Messenger;

use Vshepelev\App\Helpers\Str;
use Vshepelev\App\Helpers\Console;

class Client
{
    private const SHUTDOWN_SIGNAL = '!завершение работы';

    /** @var false|resource */
    private $socket;

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
    public function run(): void
    {
        $this->connectToServer();

        $this->handleMessaging();

        $this->closeClient();
    }

    /**
     * @throws MessengerException
     */
    private function connectToServer(): void
    {
        Console::info('Подключение к серверу...');
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_connect($this->socket, $this->unixSocketPath)) {
            throw new MessengerException('Не удалось подключиться к серверу.');
        }
    }

    private function closeClient(): void
    {
        Console::info('Закрываем соединение...');
        socket_close($this->socket);
        Console::info('Спасибо за использование!');
    }

    private function handleMessaging(): void
    {
        Console::info('Можете писать сообщения.' . PHP_EOL);

        do {
            echo '> ';
            if ($input = Console::read()) {
                $this->send($input);
            }

            $message = $this->receive();
            if ($message && !$this->isShutdownSignal($message)) {
                Console::line($message);
            }
        } while (!$this->isShutdownSignal($message));

        Console::line();
    }

    private function send(string $message): void
    {
        socket_write($this->socket, $message);
    }

    private function receive(): string
    {
        return socket_read($this->socket, $this->maxMessageLength);
    }

    private function isShutdownSignal(string $message): bool
    {
        return Str::contains($message, self::SHUTDOWN_SIGNAL);
    }
}
