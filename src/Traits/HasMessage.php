<?php

namespace Ivanboriev\SocketChat\Traits;

trait HasMessage
{

    public function info($message)
    {
        echo "\033[0;34m" . $message . "\033[0m" . PHP_EOL;
    }

    public function error($message)
    {
        echo "\033[0;31m" . $message . "\033[0m" . PHP_EOL;
    }

    public function send($message)
    {
        echo $message . PHP_EOL;
    }

}