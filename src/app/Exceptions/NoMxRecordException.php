<?php

namespace App\Exceptions;

use Exception;

class NoMxRecordException extends Exception
{
    public function __construct(string $domain, \Throwable $previous = null)
    {
        http_response_code(400);
        parent::__construct('No MX records found for domain ' . $domain, 0, $previous);
    }
}
