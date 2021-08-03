<?php


declare(strict_types=1);


namespace Chat\Sockets;


use Chat\Sockets\Templates\SocketImplementation;

final class Client extends SocketImplementation
{

    private SocketWork $socket;

    public function __construct()
    {
        $this->socket = new SocketWork($_ENV["SOCKET_PATH"], (int)$_ENV["SOCKET_PORT"]);
    }

    private function init(): void
    {
        $this->socket->create();
        $this->socket->connect();
    }

    private function waitingResponse()
    {
        echo "Server says:" . PHP_EOL . $this->socket->readFromSocket() . PHP_EOL;
    }

    private function waitForMessage()
    {
        while (true) {
            $this->init();
            echo "Enter Message:" . PHP_EOL;
            $line = $this->readline();
            $this->message($line);
            if (in_array($line, ["quit", "exit"])) {
                break;
            }
        }
    }

    private function message(string $message)
    {
        $this->socket->writeToSocket($message);
        $this->waitingResponse();
    }

    public function run(): void
    {
        $this->waitForMessage();
    }
}