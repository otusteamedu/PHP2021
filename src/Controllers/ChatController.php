<?php

declare(strict_types=1);

namespace Sources\Controllers;

use Sources\App\SocketClient;
use Sources\App\SocketServer;
use Sources\Services\SocketService;

class ChatController
{
    private SocketClient|SocketServer $instance;

    public function __construct()
    {
        $this->parseTypeOpt();
    }

    public function parseTypeOpt(): void
    {
        $getopt = getopt('', ['type:']);

        if (isset($getopt['type'])) {
            $socketService = new SocketService();

            if ($getopt['type'] === 'client') {
                $this->instance = new SocketClient($socketService);
            } elseif ($getopt['type'] === 'server') {
                $this->instance = new SocketServer($socketService);
            } else {
                throw new \Exception('parameter --type is not valid, it must be "client" or "server"');
            }
        } else {
            throw new \Exception('parameter --type is not set');
        }
    }

    public function start(): void
    {
        $this->instance->run();
    }
}