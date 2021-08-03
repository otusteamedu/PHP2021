<?php


declare(strict_types=1);


namespace Chat\Sockets;


use Chat\Sockets\Templates\SocketImplementation;

final class Server extends SocketImplementation
{

    private SocketWork $socket;

    public function __construct()
    {
        $this->socket = new SocketWork($_ENV["SOCKET_PATH"], (int)$_ENV["SOCKET_PORT"]);
        $this->init();
    }

    public function run(): void
    {
        $this->listen();
    }

    private function init(): void
    {
        $this->socket->clearSocketFile();
        $this->socket->create();
        $this->socket->bindName();
        $this->socket->listen();
    }

    private function listen(): void
    {
        while (true) {
            $this->socket->accept();

            $input = $this->socket->readFromAcceptedSocket();

            if (in_array($input, ["quit", "exit"])) {
                break;
            }
            echo "Client:" . PHP_EOL . $input . PHP_EOL . PHP_EOL;
            echo "Server:" . PHP_EOL;

            $replyToClient = $this->readline();
            $this->socket->writeToAccepted($replyToClient);
        }
    }

}