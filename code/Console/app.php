<?php

use \App\Sockets\Server;
use \App\Sockets\Client;
use \App\Sockets\Exceptions\SocketsException;

switch ($_SERVER['argv'][1]) {
    case 'server':
        try {
            $server = new Server(
                $_ENV['SOCKET_PATH'],
                $_ENV['SOCKET_PORT'],
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
                    9999,
                );
            
                $client->waitForMessage();
            
            } catch (SocketsException $e) {
                echo 'Can not connect to server', PHP_EOL;
            }
        break;
}