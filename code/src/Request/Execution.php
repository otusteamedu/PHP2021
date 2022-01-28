<?php

namespace App\Request;

use App\Queue\Subscriber;

class Execution
{

    private object $subscriber;

    public function Execution()
    {
        $this->subscriber = new Subscriber();
        $this->subscriber = $this->subscriber->Subscriber();
    }

}