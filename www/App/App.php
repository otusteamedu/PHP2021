<?php

namespace App;

use App\Requests\Request;
use App\Validators\BracketValidator;

class App
{

    public function run(): void
    {
        $request = (new Request($_REQUEST))->all();

        (new BracketValidator($request))->run();
    }
}
