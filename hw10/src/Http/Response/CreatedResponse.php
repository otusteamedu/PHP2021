<?php


namespace App\Http\Response;

use Laminas\Diactoros\Response\JsonResponse;

class CreatedResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => 'Created'], 201);
    }
}
