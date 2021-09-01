<?php

namespace Chat;

use Exception;

class App
{
    public function run($argv)
    {
        if (!isset($argv[1])) {
            echo new Exception('Необходимо передать аргумент (server или client)');
        }

        if($argv[1] == 'client') {
            $app = new Client(new AppSocket(), new Config(), new Console());
        } elseif ($argv[1] == 'server') {
            $app = new Server(new AppSocket(), new Config(), new Console());
        } else {
            $app = new Exception("Неизвестный аргумент " . $argv[1]);
        }

        return $app->start();
    }
}