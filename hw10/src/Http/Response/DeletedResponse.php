<?php


namespace App\Http\Response;


use Laminas\Diactoros\Response\JsonResponse;

class DeletedResponse extends JsonResponse
{
    public function __construct(int $deleted)
    {
        parent::__construct(['message' => 'OK', 'deleted' => $deleted]);
    }
}
