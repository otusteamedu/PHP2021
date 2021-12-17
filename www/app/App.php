<?php
namespace App;

use App\Client\Client;
use App\Server\Server;

class App
{
    public function run()
    {
        if (empty($_SERVER['argv'][1])){
            throw new \ArgumentCountError('Not enough arguments.');
        } 
        
        set_time_limit(0);
        ob_implicit_flush();

        if ($_SERVER['argv'][1] === 'client1'){
            $side = new Client($this->getConfig());   
        } elseif ($_SERVER['argv'][1] === 'server'){
            $side = new Server($this->getConfig());
        } else {
            throw new \InvalidArgumentException('Got unknown type for a socket.');
        }

        $side->run();
    }
    
    private function getConfig()
    {
       return new Config(require(__DIR__.'/../config/config.php'));
    }
}