<?php

namespace Src;

use Exception;
use Src\Otus\Client;
use Src\Otus\Server;


class Boot
{

    public function run(array $argv): void
    {
        if (empty($argv[1]) || !in_array($argv[1], ['client', 'server'])) {
            throw new Exception('Ваша команда не найдена: запустите php app.php (client|server)');
        }

        switch ($argv[1]) {
            case 'client';
                (new Client($_ENV['SOCKET_PATH'], $_ENV['SOCKET_PORT']))->waitForMessage();
                break;
            case 'server';
                (new Server($_ENV['SOCKET_PATH'], $_ENV['SOCKET_PORT']))->listen();
                break;
        }
    }
}