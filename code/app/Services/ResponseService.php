<?php declare(strict_types=1);

namespace App\Services;

class ResponseService
{
    public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        echo 'Params is empty. Please send parameter - string' . PHP_EOL;
    }

    public function success()
    {
        header("HTTP/1.0 200");
        echo 'Request is validate' . PHP_EOL;
    }

    public function isNotValidateData()
    {
        header("HTTP/1.0 400 Bad Request");
        echo 'Request is not validate' . PHP_EOL;
    }
}
