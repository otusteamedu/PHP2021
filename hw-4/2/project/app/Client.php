<?php

namespace App;

final class Client
{
    private $socket;

    public function __construct($host, $port)
    {
        $this->initSocket($host, $port);
    }

    public function waitForMessage()
    {
        echo 'Enter Message:';
        $this->message($this->readline());
    }

    private function message($message)
    {
        $this->socket->write($message);
        $this->waitingResponse();
    }

    private function initSocket($host, $port)
    {
        $this->socket = new Socket($host, $port);
        $this->socket->create();
        $this->socket->connect();
    }

    private function readline()
    {
        return rtrim(fgets(STDIN));
    }

    private function waitingResponse()
    {
        echo "Server says:\t" . $this->socket->read();
    }

    public function run()
    {
        $this->waitForMessage();
    }
}