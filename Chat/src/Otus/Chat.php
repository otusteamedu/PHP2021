<?php

namespace Otus;
use Otus\Sockets\Client;
use Otus\Sockets\Server;
class Chat
{
    public static function run(array $argv): void
    {
        if (empty($argv[1]) || !in_array($argv[1], ['client', 'server'])) {
            throw new \Exception("Usage php app.php client or php app.php server");
        }

        switch ($argv[1]) {
            case 'client':
                $client = new Client($_ENV['SOCKET_PATH'],$_ENV['SOCKET_PORT']);
                $client->waitForMessage();
                break;
            case 'server':
                $server = new Server($_ENV['SOCKET_PATH'],$_ENV['SOCKET_PORT']);
                $server->listen();
                break;
        }
    }
}