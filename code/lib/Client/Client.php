<?php
namespace App\Client;

use App\Service\Socket;
use Exception;

class Client
{

    /**
     * @throws Exception
     */
    public function run()
    {
        if (!file_exists((new Socket())->getPath())) {
            throw new Exception('Не удалось найти сокет');
        }

        $socket = socket_create(AF_UNIX,SOCK_STREAM,0);
        socket_connect($socket, (new Socket())->getPath());

        do {
            $output = readline('');
            socket_write($socket, $output,1024);
            $input = socket_read($socket, 1024);
            echo $input;
        } while ($output !== 'exit');
    }
}