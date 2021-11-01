<?php
namespace Src;

use Src\Client\Client;
use Src\Exceptions\SocketException;

class Server
{
    const INPUT_LENGTH = 1024;

    private $socket;
    private $clientSockets = [];

    private function initializeSocket()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_bind($this->socket, SOCKET_PATH . '.sock')) {
            throw new \Exception('Не удалось привязать имя к сокету');
        }
        if (!socket_listen($this->socket)) {
            throw new \Exception('Не удалось начать прослушивать соединение');
        }
    }

    private function initializeConnections()
    {
        $abort = false;
        $NULL = null;
        $read = array($this->socket);

        while (!$abort) {
            $numChanged = socket_select($read, $NULL, $NULL , 0);
            if ($numChanged) {
                $this->clientSockets[]= socket_accept($this->socket);
                echo "Принято новое подключение", PHP_EOL;
            }

            foreach($this->clientSockets as $key => $client)
            {
                if ($this->acceptClientMessage($client) === false) $abort = true;
            }
            $read[] = $this->socket;
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
        socket_close($this->socket);
        unlink(SOCKET_PATH . '.sock');
    }

    public function run($side)
    {
        try {
            switch ($side) {
                case 'server':
                    $this->runServer();
                    break;
                case 'client':
                    $this->runClient();
                    break;
                default :
                    throw new \Exception('В аргументах допустимо только client и server');
            }
        } catch (SocketException) {
            $this->shutDown();
        }
    }

    public function runServer()
    {
        if (file_exists(SOCKET_PATH . '.sock')) {
            unlink(SOCKET_PATH . '.sock');
        }
        $this->initializeSocket();
        $this->initializeConnections();
    }

    public function runClient()
    {
        if (!file_exists(SOCKET_PATH . '.sock')) {
            throw new \Exception('Сокет не существует');
        }
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        socket_connect($this->socket, SOCKET_PATH . '.sock');

        do {
            $output = readline('');
            if (!socket_write($this->socket, $output)) {
                throw new SocketException();
            };
            $input = socket_read($this->socket, 1024);
            echo $input;
        } while ($input != 'exit' && $input);
    }
}