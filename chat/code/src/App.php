<?php

namespace Chat;

Use \Exception;

class App
{
    public const TYPE_CLIENT = "client";
    public const TYPE_SERVER = "server";

    public function run($argv)
    {
        if (!isset($argv[1])) {
            throw new Exception('Необходимо передать аргумент (server или client)');
        }

        $app = match ($argv[1]) {
            static::TYPE_CLIENT => new Client(new AppSocket(), new Config(), new Console()),
            static::TYPE_SERVER => new Server(new AppSocket(), new Config(), new Console()),
            default => throw new Exception("Неизвестный аргумент " . $argv[1])
        };

        $app->start();
    }
}
