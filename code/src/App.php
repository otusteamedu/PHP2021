<?php

namespace App;

use App\Request\Accepted;

class App
{

    public function run()
    {
        (new Accepted())->Accepted();
    }
}