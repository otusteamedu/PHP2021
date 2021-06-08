<?php


namespace App\Socket;


class Socket implements SocketInterface
{
    public \Socket $socket;

    public function __construct(\Socket $socket)
    {
        $this->socket = $socket;

        socket_set_block($this->socket);
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @throws SocketException
     */
    public function bind(string $addr)
    {
        if (socket_bind($this->socket, $addr) === false) {
            $this->throwSocketException();
        }
    }

    /**
     * @throws SocketException
     */
    public function connect(string $addr)
    {
        if (socket_connect($this->socket, $addr) === false) {
            $this->throwSocketException();
        }
    }

    /**
     * @throws SocketException
     */
    public function listen()
    {
        if (socket_listen($this->socket,1) === false) {
            $this->throwSocketException();
        }
    }

    /**
     * @throws SocketException
     */
    public function accept(): Socket
    {
        $socket = socket_accept($this->socket);

        if ($socket === false) {
            $this->throwSocketException();
        }

        return new Socket($socket);
    }

    /**
     * @throws SocketException
     */
    public function read(): string
    {
        $data = socket_read($this->socket, ord('\n'), PHP_NORMAL_READ);

        if ($data === false) {
            $this->throwSocketException();
        }

        return $data;
    }

    /**
     * @throws SocketException
     */
    public function write(string $data): int
    {
        $nBytes = socket_send($this->socket, $data, strlen($data), MSG_EOF);

        if ($nBytes === false) {
            $this->throwSocketException();
        }

        return $nBytes;
    }

    public function close()
    {
        socket_close($this->socket);
    }

    /**
     * @throws SocketException
     */
    protected function throwSocketException()
    {
        $code = socket_last_error($this->socket);

        throw new SocketException(socket_strerror($code), $code);
    }
}
