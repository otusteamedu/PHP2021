<?php

namespace Src;

use Src\Client\Client;
use Src\Server\Server;

class App {

    public function run()
    {
        $side = $_SERVER['argv'][1];
        switch ($side) {
            case 'server':
                $server = new Server();
                $server->run();
                break;
            case 'client':
                $server = new Client();
                $server->run();
                break;
            default:
                throw new \Exception('Параметром может быть только client или server');
        }
    }
}