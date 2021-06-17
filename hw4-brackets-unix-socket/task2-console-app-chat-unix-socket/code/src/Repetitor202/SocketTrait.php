<?php


namespace Repetitor202;


trait SocketTrait
{
    public $socket = null;
    public $socketFile = null;
    private EchoMessage $echoMessage;

    public function __construct()
    {
        $this->echoMessage = new EchoMessage();

        $this->createSocket();
        $this->bindSocket();
    }

    public function createSocket()
    {
        try {
            $this->echoMessage->write('>>Creating socket ');
            $this->socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
            $this->socketFile = $_ENV['SOCKET_FILE'];
        } catch (\Exception $e) {
            $message = 'Could not create socket ' . $e->getMessage() . PHP_EOL;
            $message .= socket_strerror(socket_last_error()) . PHP_EOL;

            throw new \Exception($message);
        }
    }

    public function bindSocket()
    {
        $this->echoMessage->write('>>Binding socket ');

        if (file_exists($this->socketFile)) {
            unlink($this->socketFile);
        }

        if (!socket_bind($this->socket, $this->socketFile)) {
            $message = 'Unable to bind to ' . $this->socketFile . PHP_EOL;
            $message .= socket_strerror(socket_last_error()) . PHP_EOL;

            throw new \Exception($message);
        }
    }
}