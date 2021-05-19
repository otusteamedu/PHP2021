<?php

namespace App;

class App
{
    private SocketAppFactory $factory;
    private $type;

    public function __construct($type = null)
    {
        $this->type = $type;
        $this->factory = new SocketAppFactory();
    }

    public function run()
    {
        $this->factory->createInstance($this->type)->run();
    }
}