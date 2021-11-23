<?php

namespace App;


class App
{
    protected string $serverType;
    protected const TYPE_SERVER = 'server';
    protected const TYPE_CLIENT = 'client';

    public function __construct(string $serverType)
    {
        $this->serverType = $serverType;
    }

    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        if ($this->serverType == self::TYPE_SERVER){
            $server = new Server();
            $server->runServer();
        } elseif ($this->serverType == self::TYPE_CLIENT){
            $server = new Client();
            $server->runServer();
        }
    }
}