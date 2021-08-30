<?php

namespace Dmigrishin\Chat;

use Exception;
use Dmigrishin\Chat\SocketChat\Client;
use Dmigrishin\Chat\SocketChat\Server;

class App
{
    public function run()
    {
        $role = $_SERVER['argv'][1];

        if($role == 'server') {
           $socketserver = Server::startserver();
           $socketserver->serve();
        } elseif ($role == 'client') {
            $socketclient = Client::startclient();
            //var_dump($socketclient);
            $socketclient->communicate();
            
        } else {
            throw new Exception('Укажите аргумент: server, client' . PHP_EOL);
        }
    }
}