<?php

namespace Ivanboriev\TrustedBrackets\Request;

class Request
{
    private string $method;

    private static string $contentType;

    private array $payload = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        self::$contentType = $_SERVER['CONTENT_TYPE'];
        $this->payload = self::getPayload($this->method);
    }


    /**
     * @param $method
     * @return array|mixed
     */
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

    /**
     * @return mixed|string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * @return array|mixed
     */
    public function payload()
    {
        return $this->payload;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() === "POST";
    }
}