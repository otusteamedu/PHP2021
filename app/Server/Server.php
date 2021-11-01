<?php declare(strict_types=1);

namespace App\Server;

use App\Services\SocketService;

class Server
{
    private SocketService $socketService;

    public function __construct()
    {
        $this->socketService = new SocketService();
    }

    public function handle()
    {
        try {
            $this->socketService->close();

            echo "Start server" . PHP_EOL;

            $this->socketService->initSocket();
            $this->socketService->listen();

            $this->startListen();
        } catch (\Exception $exception) {
            echo PHP_EOL . $exception->getMessage() . PHP_EOL;
        } finally {
            $this->socketService->close();
            echo "Server network has closed" . PHP_EOL;
        }
    }

    private function startListen(): void
    {
        do {
            echo 'Server is waiting connect client' . PHP_EOL;

            $this->socketService->initAccept();

            echo 'Client connected' . PHP_EOL;

            $this->socketService->sendMessage('Hi client!');

            do {

                $message = $this->socketService->getMessage();

                if (empty($message)) {
                    continue;
                }

                if ($message === 'exit') {
                    $this->socketService->close();
                    echo 'Serve is down' . PHP_EOL;

                    break 2;
                }

                $this->socketService->sendMessage("Server got message \"$message\", code: 200");

                echo "Client has written - " . $message . PHP_EOL;
                echo "======================================" . PHP_EOL;
            } while (true);
        } while (true);
    }
}
