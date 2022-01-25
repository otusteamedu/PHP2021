<?php

namespace App\Order;

use App\Order\Rabbit\Consumer;

class Execution
{

    private object $consumer;

    public function Execution()
    {
        $this->consumer = new Consumer();
        $this->consumer = $this->consumer->Consumer();
    }

}