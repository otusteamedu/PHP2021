<?php


namespace Chat\Sockets;


class Server implements Runnable
{

    private Socket $socket;

    public function __construct()
    {
        $this->socket = new Socket($_ENV["SOCKET_PATH"], $_ENV["SOCKET_PORT"]);
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

    private function readline(): string
    {
        return rtrim(fgets(STDIN));
    }


}