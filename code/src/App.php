<?php
#Строгая типизация
declare(strict_types=1);

namespace App;

use App\Server\Server;
use App\Client\Client;


class App
{
    private string $nameService;

    private const SERVER_NAME = 'server';
    private const CLIENT_NAME = 'client';

    public function __construct(string $argServ)
    {
        $this->nameService = $argServ;
    }
    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        $nameService1 = $this->nameService;

        if($nameService1 === self::SERVER_NAME) {
            $server = new Server();
            $server->runServer();
        }elseif($nameService1 === self::CLIENT_NAME){
            $client = new Client();
            $client->runClient();

       }

    }
}
