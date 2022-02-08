<?php


namespace App\Application\DTO;


class QueueConnectionDTO
{
    /**
     * QueueConnectionDTO constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $pass
     * @param $vhost
     * @param $exhange
     * @param $queue
     * @param $consumer
     * @param $email
     */
    public function __construct($host, $port, $user, $pass, $vhost,)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->vhost = $vhost;
    }

    public $host;
    public $port;
    public $user;
    public $pass;
    public $vhost;


}