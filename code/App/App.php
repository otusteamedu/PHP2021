<?php

namespace App;

use Core\Router;
use App\Sockets\Client;
use App\Sockets\Server;

class App {
    
    public function run($param){

        switch ($param) {
            case 'server':
                try {
                    $server = new Server(
                        '/tmp/otus.sock',
                        9998,
                    );
                    $server->listen();
                } catch (SocketsException $e) {
                    echo 'SocketsException', PHP_EOL;
                }
                break;
            case 'client':
                    try {
                        $client = new Client(
                            '/tmp/otus.sock',
                            9998,
                        );
                        $client->waitForMessage();
                    } catch (SocketsException $e) {
                        echo 'Can not connect to server', PHP_EOL;
                    }
                break;
        }
          

    }

}