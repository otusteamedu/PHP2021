<?php
declare(strict_types=1);

namespace App;

use App\Source\Result;

class App
{


    public function run(): void
    {
        $result = new Result();
        $result->run();

    }
}