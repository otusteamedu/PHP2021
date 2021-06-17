<?php


namespace Repetitor202;


class Server
{
    use SocketTrait;

    private EchoMessage $echoMessage;

    public function __construct()
    {
        $this->echoMessage = new EchoMessage();
        $this->echoMessage->write('Server');

        $this->createSocket();
        $this->bindSocket();
    }

    public function listen()
    {
        $this->echoMessage->write('>> Listening for messages');

        $run = true;
        while($run){
            $buf = '';
            $from = '';

            try {
                $bytes_received = socket_recvfrom($this->socket, $buf, 65536, 0, $from);
                if ($bytes_received == -1) {
                    $this->echoMessage->writeError('An error occured while receiving from the socket');
                } else {
                    $this->echoMessage->write('New message: ' . $buf);
                }
            } catch (\Exception $e) {
                $run = false;
                $this->echoMessage->writeError($e->getMessage());
            }
        }
    }
}