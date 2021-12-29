<?php

namespace App;

class Server
{
    private $socket;
    private $connection;
    private $port = null;
    private $stopMsg = null;
    private $socketPath = null;

    /**
     * @throws \Exception
     */
    public function run()
    {
        $this->configure();
        $this->initSocket();
        $this->initConnection();
        $this->readMessages();
        $this->closeSocket();
    }

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
    private function initSocket()
    {
        // Создаёт сокет (конечную точку для обмена информацией)
        if (($this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0)) === false) {
            throw new \Exception('Не удалось выполнить socket_create(): причина: ' . socket_strerror(socket_last_error()));
        }

        // Привязывает имя к сокету
        if (socket_bind($this->socket, $this->socketPath, $this->port) === false) {
            throw new \Exception('Не удалось выполнить socket_bind(): причина: ' . socket_strerror(socket_last_error($this->socket)));
        }

        // Прослушивает входящие соединения на сокете
        if (socket_listen($this->socket, 5) === false) {
            throw new \Exception('Не удалось выполнить socket_listen(): причина: ' . socket_strerror(socket_last_error($this->socket)));
        }

        echo 'Сокет инициализирован.'.PHP_EOL;
    }

    /**
     * @throws \Exception
     */
    private function initConnection()
    {
        // Принимает соединение на сокете
        if (($this->connection = socket_accept($this->socket)) === false) {
            throw new \Exception('Не удалось выполнить socket_accept(): причина: ' . socket_strerror(socket_last_error($this->socket)));
        }

        echo "Соединение установлено, ожидаем сообщение." . PHP_EOL;
    }

    /**
     * @throws \Exception
     */
    private function readMessages()
    {
        do {
            if (false === ($buf = socket_read($this->connection, 2048, PHP_NORMAL_READ))) {
                throw new \Exception('Не удалось выполнить socket_read(): причина: ' . socket_strerror(socket_last_error($this->socket)));
                break;
            }

            echo 'Полученное сообщение: ' . $buf;

            if (!$buf = trim($buf)) {
                continue;
            }

            if ($buf === $this->stopMsg) {
                $this->closeConnection();
                break;
            }

            $talkback = 'Received '.strlen($buf).' bytes';
            socket_write($this->connection, $talkback, strlen($talkback));
        } while (true);
    }

    private function closeConnection()
    {
        socket_close($this->connection);
        echo 'Соединение закрыто.'.PHP_EOL;
    }

    private function closeSocket()
    {
        socket_close($this->socket);
        unlink($this->socketPath);
        echo 'Cокет закрыт.'.PHP_EOL;
    }
}