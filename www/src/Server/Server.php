<?php
namespace Src\Server;

class Server
{
    const INPUT_LENGTH = 1024;

    private $socket;

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
        $clientSockets = [];
        $abort = false;
        $NULL = null;
        $read = array($this->socket);

        while (!$abort) {
            $numChanged = socket_select($read, $NULL, $NULL , 0);
            if ($numChanged) {
                $clientSockets[]= socket_accept($this->socket);
                echo "Принято новое подключение", PHP_EOL;
            }

            foreach($clientSockets as $key => $client)
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
                $this->shutDown($client);
                return false;
            }
            $input = trim($input);
            echo $input, PHP_EOL;
            if (!socket_write($client, "Вы сказали: $input\n") )
            {
                socket_close($client);
            }
        }
    }

    private function shutDown($client)
    {
        socket_write($client, "exit");
        socket_shutdown($client);
        socket_close($this->socket);
    }

    public function run()
    {
        if (file_exists(SOCKET_PATH . '.sock')) {
            unlink(SOCKET_PATH . '.sock');
        }
        $this->initializeSocket();
        $this->initializeConnections();
        unlink(SOCKET_PATH . '.sock');
    }
}