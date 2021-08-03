<?php

namespace App\App;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HttpCore
{
    static public function handleResponse(Response $response)
    {
        try {
            http_response_code($response->getStatusCode());
            print $response->getContent();
        } catch (Exception $e) {
            http_response_code(500);
            print "Server error";
        }
    }

    static public function makeRequest(): Request
    {
        return Request::createFromGlobals();
    }
}