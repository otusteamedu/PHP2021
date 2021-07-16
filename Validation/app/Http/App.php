<?php

namespace App\Http;

use App\Exception\EmptyParamsException;
use App\Exception\InvalidMethodException;
use App\Exception\InvalidStringException;


class App
{
    /**
     * @throws InvalidMethodException
     * @throws EmptyParamsException
     * @throws InvalidStringException
     */

    public function run()
    {
        Router::init();
    }
}
