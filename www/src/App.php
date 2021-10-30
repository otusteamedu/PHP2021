<?php

namespace Src;

use Src\Server\Server;
use Src\Client\Client;

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
        }
    }
}