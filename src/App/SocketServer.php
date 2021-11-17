<?php

declare(strict_types=1);

namespace Sources\App;

use Sources\Services\SocketService;
use Sources\Exceptions\SocketException;

class SocketServer
{
    private \Socket $acceptedSocket;
    private SocketService $socketService;

    public function __construct(SocketService $socketService)
    {
        $this->socketService = $socketService;
    }

    public function run() {
        $this->socketService->create();
        $this->socketService->bind();
        $this->socketService->listen();

        while (true) {
            $this->acceptedSocket = $this->socketService->accept();
            echo PHP_EOL;

            while (true) {
                $read = $this->socketService->read($this->acceptedSocket);

                if (empty($read)) {
                    continue;
                }
                if ($read === 'exit') {
                    break;
                }

                echo 'Client says: ' . $read . PHP_EOL;
            }

            $this->socketService->close($this->acceptedSocket);
        }
    }
}