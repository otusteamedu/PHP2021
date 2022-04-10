<?php

namespace Ivanboriev\TrustedBrackets\Request;

class Request
{
    private $method;

    private static $contentType;

    private $payload = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        self::$contentType = $_SERVER['CONTENT_TYPE'];
        $this->payload = self::getPayload($this->method);
    }


    private static function getPayload($method)
    {
        if ($method === "GET") {
            return $_GET;
        }

        if ($method === "POST") {
            return self::$contentType === 'application/json' ? json_decode(file_get_contents('php://input'), true) : $_POST;
        }

        return [];
    }

    public function method()
    {
        return $this->method;
    }

    public function payload()
    {
        return $this->payload;
    }

    public function isPost()
    {
        return $this->method() === "POST";
    }
}