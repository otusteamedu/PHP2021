<?php


namespace Repetitor202;


class Client
{
    use SocketTrait;

    private EchoMessage $echoMessage;

    public function __construct()
    {
        $this->echoMessage = new EchoMessage();
        $this->echoMessage->write('Client');

        $this->createSocket();
    }

    public function sendData()
    {
        while(true){
            try {
                $this->echoMessage->write('>> Insert message: ');

                $msg = trim(fgets(STDIN, 1024));
                $len = strlen($msg);
                socket_sendto($this->socket, $msg, $len, 0, $this->socketFile, 0);

                $this->echoMessage->write('Message has been received by server: ' . $msg);
            } catch (\Exception $e) {
                $this->echoMessage->writeError($e->getMessage());
            }

        }
    }
}