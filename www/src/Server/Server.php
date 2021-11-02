<?php
namespace Src\Server;

use Src\Exceptions\SocketException;
use Src\SocketServer;

class Server extends SocketServer
{
    public function __construct()
    {
        if (file_exists(SOCKET_PATH . '.sock')) {
            unlink(SOCKET_PATH . '.sock');
        }
    }

    protected function initializeConnection()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!socket_bind($this->socket, SOCKET_PATH . '.sock')) {
            throw new \Exception('Не удалось привязать имя к сокету');
        }
        if (!socket_listen($this->socket)) {
            throw new \Exception('Не удалось начать прослушивать соединение');
        }
    }

    protected function acceptMessages()
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

    protected function closeConnection()
    {
        parent::closeConnection();
        unlink(SOCKET_PATH . '.sock');
    }

    private function acceptClientMessage($client)
    {
        $input = socket_read($client, $this::INPUT_LENGTH);
        if ($input) {
            if($input == 'exit')
            {
                throw new SocketException();
            }
            $input = trim($input);
            echo $input, PHP_EOL;
            if (!socket_write($client, "Вы сказали: $input\n") )
            {
                throw new SocketException();
            }
        }
    }
}