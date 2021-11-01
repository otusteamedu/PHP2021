<?php

namespace App\Service;

class Socket
{
    private $config;

    public function __construct()
    {
        $this->config = parse_ini_file('./configs/config.ini');
    }

    public function getPath()
    {
        return $this->config['path'];
    }
}