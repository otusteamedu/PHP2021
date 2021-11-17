<?php

declare(strict_types=1);

namespace Sources\App;

use Sources\Services\SocketService;

class SocketClient
{
    private SocketService $socketService;

    public function __construct(SocketService $socketService)
    {
        $this->socketService = $socketService;
    }

    public function run() {
        $this->socketService->create();
        $this->socketService->connect();

        echo PHP_EOL . 'Please enter your message or "exit" to stop client:' . PHP_EOL;

        while (true) {
            $msg = fgets(STDIN, SocketService::READ_LENGTH);
            $this->socketService->write($msg);

            if ($msg === 'exit' . PHP_EOL) {
                break;
            }
        }

        $this->socketService->close();
    }
}