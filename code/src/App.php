<?php

namespace App;

use App\Products\White\Burger;
use App\Products\White\Sandwich;

class App
{

    public function run()
    {
        (new Burger())->Burger();

        echo "<br>";
        echo "<br>";

        (new Sandwich())->Sandwich();
    }
}