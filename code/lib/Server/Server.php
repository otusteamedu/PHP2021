<?php

namespace App\Server;

use App\Service\Socket;
use Exception;

class Server
{
    private $connection;

    public function run()
    {
        try {
            $socketService = new Socket();
            $this->connection = $socketService->initializeServer();
            $this->acceptMessage();
        } catch (Exception $e) {
            echo $e->getMessage().PHP_EOL;
        } finally {
            $socketService->closeConnectionAndSocket();
        }
    }

    private function acceptMessage()
    {
        echo "Ожидаю сообещения...".PHP_EOL;
        do {
            $message = socket_read($this->connection, 1024);
            $len = strlen($message);
            socket_write($this->connection, "Received {$len}bytes".PHP_EOL);
            echo $message.PHP_EOL;
        } while ($message !== 'exit');
    }
}