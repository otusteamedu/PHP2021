<?php

namespace App;

class Client
{
    private $socket;
    private $port = null;
    private $stopMsg = null;
    private $socketPath = null;

    /**
     * @throws \Exception
     */
    public function run()
    {
        $this->configure();
        $this->initConnection();
        $this->sendMessages();
        $this->closeConnection();
    }

    /**
     * @throws \Exception
     */
    private function configure()
    {
        if ($config = parse_ini_file('config/app.ini')) {
            $this->port = $config['port'];
            $this->socketPath = $config['path'];
            $this->stopMsg = $config['stopMsg'];
        } else {
            throw new \Exception('Не удалось прочитать конфигурацию');
        }
    }

    /**
     * @throws \Exception
     */
    private function initConnection()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if ($this->socket === false) {
            throw new \Exception('Не удалось выполнить socket_create(). Причина: ' . socket_strerror(socket_last_error()));
        }

        $result = socket_connect($this->socket, $this->socketPath, $this->port);
        if ($result === false) {
            throw new \Exception('Не удалось выполнить socket_connect(). Причина: ' . socket_strerror(socket_last_error($this->socket)));
        }

        echo 'Соединение установлено, введите сообщение:'.PHP_EOL;
    }

    private function sendMessages()
    {
        while ($msg = fgets(STDIN)) {
            socket_write($this->socket, $msg, strlen($msg));

            // Ответ сервера закрывающего соединение
            if (trim($msg) == $this->stopMsg) {
                break;
            }

            $out = socket_read($this->socket, 2048);

            echo 'Ответ сервера: ' . $out . PHP_EOL;
        }
    }

    private function closeConnection()
    {
        echo "Закрываем соединение...".PHP_EOL;
        socket_close($this->socket);
        echo 'Соединение закрыто'.PHP_EOL;
    }
}