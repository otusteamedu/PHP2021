<?php

namespace App2;

use App\Queue\Subscriber;

class App2
{

    public function run()
    {
        (new Subscriber())->Subscriber();
    }
}