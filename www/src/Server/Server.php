<?php
namespace Src\Server;

use Src\Exceptions\SocketException;

class Server
{
    const INPUT_LENGTH = 1024;

    private $serverSocket;
    private $clientSockets = [];

    private function initializeSocket()
    {
        $this->serverSocket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_bind($this->serverSocket, SOCKET_PATH . '.sock')) {
            throw new \Exception('Не удалось привязать имя к сокету');
        }
        if (!socket_listen($this->serverSocket)) {
            throw new \Exception('Не удалось начать прослушивать соединение');
        }
    }

    private function initializeConnections()
    {
        $abort = false;
        $NULL = null;
        $read = array($this->serverSocket);

        while (!$abort) {
            $numChanged = socket_select($read, $NULL, $NULL , 0);
            if ($numChanged) {
                $this->clientSockets[]= socket_accept($this->serverSocket);
                echo "Принято новое подключение", PHP_EOL;
            }

            foreach($this->clientSockets as $key => $client)
            {
                if ($this->acceptClientMessage($client) === false) $abort = true;
            }
            $read[] = $this->serverSocket;
        }
    }

    private function acceptClientMessage($client)
    {
        $input = socket_read($client, $this::INPUT_LENGTH);
        if ($input) {
            if($input == 'exit')
            {
                $this->shutDown();
                return false;
            }
            $input = trim($input);
            echo $input, PHP_EOL;
            if (!socket_write($client, "Вы сказали: $input\n") )
            {
                throw new SocketException();
            }
        }
    }

    public function shutDown()
    {
        foreach ($this->clientSockets as $clientSocket) {
            socket_write($clientSocket, "exit");
            socket_shutdown($clientSocket);
        }
        socket_close($this->serverSocket);
        unlink(SOCKET_PATH . '.sock');
    }

    public function run()
    {
        if (file_exists(SOCKET_PATH . '.sock')) {
            unlink(SOCKET_PATH . '.sock');
        }
        $this->initializeSocket();
        try {
            $this->initializeConnections();
        } catch (SocketException) {
            $this->shutDown();
            return false;
        }
    }
}