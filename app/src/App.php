<?php

declare(strict_types=1);

namespace App;

use App\Client\Client;
use App\Config\Config;
use App\Reader\IniReader;
use App\Server\Server;
use App\Socket\SocketService;

class App
{
    private const TYPE_SERVER = 'server';
    private const TYPE_CLIENT = 'client';

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        if (empty($_SERVER['argv'][1])) {
            throw new \Exception("Первым параметром нужно передать тип приложения");
        }
        $type = $_SERVER['argv'][1];

        $config = new Config(__DIR__ . '/../config.ini', new IniReader());

        $exitPhrase = $config->getValue('socket.exit_phrase');
        if (empty($exitPhrase)) {
            $exitPhrase = 'выход';
        }

        $socketService = new SocketService($config->getValue('socket.path'));

        switch ($type) {
            case self::TYPE_SERVER:
                $server = new Server($socketService, $exitPhrase);
                $server->run();
                break;
            case self::TYPE_CLIENT:
                $server = new Client($socketService, $exitPhrase);
                $server->run();
                break;
            default:
                throw new \Exception('Передан не правильный тип приложения');
                break;
        }
    }
}
