<?php

namespace App\Queue;

use App\Rabbit\Consumer;

class Subscriber
{

    public function Subscriber()
    {
        (new Consumer($this->message))->Consumer();

    }

}