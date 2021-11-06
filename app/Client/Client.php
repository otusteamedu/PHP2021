<?php declare(strict_types=1);

namespace App\Client;

use App\Constants\Socket;
use App\Services\SocketService;

class Client
{
    private SocketService $socketService;

    public function __construct()
    {
        $this->socketService = new SocketService();
    }

    public function handle()
    {
        try {
            $this->socketService->initSocket();
            $this->socketService->connect();
            $this->startListen();
        } catch (\Exception $exception) {
            echo PHP_EOL . $exception->getMessage() . PHP_EOL;
        } finally {
            $this->socketService->close();

            echo "Client network has closed" . PHP_EOL;
        }
    }

    private function startListen(): void
    {
        do {
            $message = $this->socketService->getMessage();

            if (!empty($message)) {
                echo $message . PHP_EOL;
            }

            $message = fgets(STDIN);

            if (!empty($message)) {
                $this->socketService->sendMessage($message);

                if (trim(preg_replace('/\s\s+/',' ', $message)) === Socket::EXIT) {
                    break;
                }
            }
        } while (true);
    }
}
