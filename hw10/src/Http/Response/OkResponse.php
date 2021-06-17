<?php


namespace App\Http\Response;

use Laminas\Diactoros\Response\JsonResponse;

class OkResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => 'OK'], 200);
    }
}