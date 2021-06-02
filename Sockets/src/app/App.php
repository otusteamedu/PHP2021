<?php

namespace App;

use App\Socket\Client;
use App\Socket\Server;
use Exception;

class App
{
    public function run($argv)
    {
        if (empty($argv[1]) or !in_array($argv[1], ['client', 'server'])) {
            throw new Exception("Error:\tmissing required parameter\nUsage:\tphp app.php client|server" . PHP_EOL);
        }

        switch ($argv[1]) {
            case 'client':
                $client = new Client($_ENV['SOCKET_PATH']);
                $client->waitForMessage();
                break;
            case 'server':
                $server = new Server($_ENV['SOCKET_PATH']);
                $server->listen();
                break;
        }
    }
}
