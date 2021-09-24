<?php

namespace HW9;

use Exception;

class App
{
    public function run(array $argv) : void
    {
        if (empty($argv[1])) {
            $e = 'Missing app type.' . "\r\n";
            $e .= 'Usage:' . "\r\n";
            $e .= ' - php app.php index - to index the list of videos;' . "\r\n";
            $e .= ' - php app.php stats - to get each channels\' statistics;' . "\r\n";
            $e .= ' - php app.php top - to get top 3 channels by likes/dislikes ratio.' . "\r\n";
            
            throw new Exception($e);
        }

        $router = new Router();
        $router->switch($argv[1]);
    }
}
