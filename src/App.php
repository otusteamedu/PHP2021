<?php

namespace Ivanboriev\SocketChat;

use Exception;
use Ivanboriev\SocketChat\Exceptions\UnknownCommandException;
use Ivanboriev\SocketChat\Server\Server;
use Ivanboriev\SocketChat\Client\Client;
use Ivanboriev\SocketChat\Traits\HasMessage;

class App
{
    use HasMessage;

    private array $config;

    public function __construct()
    {
        $this->config = parse_ini_file('config.ini');
    }

    /**
     * @throws Exception
     */
    public function run($type): void
    {
        switch ($type) {
            case 'server':
                $this->runServer();
                break;
            case 'client' :
                $this->runClient();
                break;
            default:
                throw new UnknownCommandException($type . ' - неизвестная команда');
        }
    }


    private function runServer()
    {
        (new Server)->run($this->config);
    }


    private function runClient()
    {
        (new Client)->run($this->config);
    }

}