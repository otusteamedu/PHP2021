<?php

namespace App;


use Dotenv\Dotenv;
use Memcached;

class App
{
    public function run()
    {
        echo 'SERVER_ADDR - ' . $_SERVER['SERVER_ADDR'] . PHP_EOL;
        echo '<br>' . PHP_EOL;

        $mem_var = new Memcached();

        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
        $mem_var->addServer($_ENV['MEMCACHED_SERVER'], $_ENV['MEMCACHED_PORT']);
        $response = $mem_var->get("Bilbo");
        if ($response) {
            echo $response;
        } else {
            echo "Adding Keys (K) for Values (V), You can then grab Value (V) for your Key (K) \m/ (-_-) \m/ ";
            $mem_var->set("Bilbo", "Here s Your (Ring) Master stored in MemCached (^_^)");
        }


    }
}