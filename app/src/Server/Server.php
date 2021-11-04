<?php

declare(strict_types=1);

namespace App\Server;

use App\Socket\SocketService;
use Exception;

/**
 * Сервер.
 */
class Server
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
            $this->socketService->initializeSocket();
            $this->socketService->initializeConnection();
            $this->acceptMessages();
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        } finally {
            $this->socketService->closeConnection();
            $this->socketService->closeSocket();
            $this->socketService->deleteSocketFile();
        }
    }

    /**
     * Принимает сообщения до тех пор, пока не получит строку $this->exitPhrase.
     *
     * @throws Exception
     */
    private function acceptMessages(): void
    {
        echo "Ожидаю сообщения..." . PHP_EOL;
        do {
            $message = $this->socketService->readMessage();
            $message = trim($message);
            echo $message . PHP_EOL;

            $this->socketService->writeMessage('Received "' . strlen($message) . '" bytes');
        } while ($message !== $this->exitPhrase);
    }

}
