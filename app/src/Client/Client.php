<?php

declare(strict_types=1);

namespace App\Client;

use App\Socket\SocketService;
use Exception;

/**
 * Сервер.
 */
class Client
{
    private SocketService $socketService;

    /** @var string $exitPhrase фраза для выхода из чата */
    private string $exitPhrase;

    /**
     * Server constructor.
     *
     * @param SocketService $socketService
     * @param string $exitPhrase
     */
    public function __construct(SocketService $socketService, string $exitPhrase)
    {
        $this->socketService = $socketService;
        $this->exitPhrase = $exitPhrase;
    }

    /**
     * Запускает сервер.
     */
    public function run()
    {
        try {
            $this->socketService->connectToSocket();
            $this->sendMessage();
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        } finally {
            $this->socketService->closeSocket();
        }
    }

    /**
     * Отправка сообщений, пока не передадим сообщение $this->exitPhrase
     * @throws Exception
     */
    private function sendMessage(): void
    {
        echo "Начинаем отправку сообщений..." . PHP_EOL;
        do {
            $message = readline('Сообщение: ');
            if (!empty($message)) {
                $this->socketService->writeMessage($message);
            }

            $responce = $this->socketService->readMessage();
            if ($responce === false) {
                throw new Exception('System did not get message');
            }
            if (!empty($responce)) {
                echo $responce . PHP_EOL;
            }
        } while ($message !== $this->exitPhrase);
    }
}
