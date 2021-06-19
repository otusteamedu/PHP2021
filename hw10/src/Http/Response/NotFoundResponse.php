<?php


namespace App\Http\Response;

use Laminas\Diactoros\Response\JsonResponse;

class NotFoundResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => 'Not found'], 404);
    }
}