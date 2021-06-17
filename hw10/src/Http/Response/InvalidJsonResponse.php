<?php


namespace App\Http\Response;

use Laminas\Diactoros\Response\JsonResponse;

class InvalidJsonResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => 'Invalid json'], 400);
    }
}