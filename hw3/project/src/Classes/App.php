<?php

namespace App\Classes;


use App\Classes\Config\FileStoredConfigReader;
use App\Classes\Exceptions\IncorrectParamsErrorException;
use App\Classes\Parsers\IniFileParser;
use App\Classes\Sockets\Client\Client;
use App\Classes\Sockets\Server\Server;

class App
{
    private $serverMode;

    public function __construct(array $commandLineArgs)
    {
        $modeParameter = $commandLineArgs[1] ?? null;

        if (($modeParameter !== 'server') && ($modeParameter !== 'client')) {

            throw new IncorrectParamsErrorException();
        }

        $this->serverMode = ($modeParameter === 'server');
    }

    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        $configFilePath = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'config.ini']);
        $config = new FileStoredConfigReader(new IniFileParser($configFilePath));
        if ($this->serverMode) {
            $socket = new Server($config);
        } else {
            $socket = new Client($config);
        }

        $socket->run();
    }
}
