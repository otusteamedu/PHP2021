<?php

namespace Src;

class App {

    public function run()
    {
        $side = $_SERVER['argv'][1];
        $server = new Server();
        $server->run($side);
    }
}