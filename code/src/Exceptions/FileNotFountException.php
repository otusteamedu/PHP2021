<?php

namespace App\Exceptions;

use Exception;

class FileNotFountException extends Exception
{
    public function __construct($pathToFile)
    {
        parent::__construct();
        $this->message = 'File on found in ' . $pathToFile;
    }
}
