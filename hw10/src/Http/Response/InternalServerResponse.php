<?php


namespace App\Http\Response;

use Laminas\Diactoros\Response\JsonResponse;

class InternalServerResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => 'Internal server error'], 500);
    }
}
