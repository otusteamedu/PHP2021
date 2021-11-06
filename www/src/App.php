<?php

declare(strict_types=1);

namespace App;

use App\Client\Client;
use App\Server\Server;

class App
{
    public const SOCKET_PATH = '/tmp/chat-sockets.sock';

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        $type = $_SERVER['argv'][1];

        if ($type === 'server') {
            $app = new Server();
        } elseif ($type === 'client') {
            $app = new Client();
        } else {
            throw new \Exception('Что-то пошло не так:( Возможно вы не server или client.');
        }

        $app->run();
    }
}
