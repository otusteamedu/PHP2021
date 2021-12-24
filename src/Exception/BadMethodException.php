<?php

namespace App\Exception;

use Exception;

class BadMethodException extends Exception
{
    public function __construct()
    {
        parent::__construct('', 405);
    }
}
