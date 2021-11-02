<?php
namespace Src;

use Src\Exceptions\SocketException;

abstract class SocketServer
{
    const INPUT_LENGTH = 1024;

    protected $socket;
    protected $clientSockets = [];

    protected function initializeConnection()
    {

    }

    protected function acceptMessages()
    {

    }

    protected function closeConnection()
    {
        foreach ($this->clientSockets as $clientSocket) {
            socket_write($clientSocket, "exit");
            socket_shutdown($clientSocket);
        }
        socket_close($this->socket);
    }

    public function run()
    {
        try {
            $this->initializeConnection();
            $this->acceptMessages();
        } catch (SocketException $exception) {
            echo $exception->getMessage();
        } finally {
            $this->closeConnection();
        }
    }

}