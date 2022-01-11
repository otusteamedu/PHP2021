<?php

namespace App\Request;

use App\Rabbit\Consumer;

class Execution
{

    private object $consumer;

    public function Execution()
    {
        $this->consumer = new Consumer();
        $this->consumer = $this->consumer->Consumer();
    }

}