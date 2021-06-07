<?php declare(strict_types=1);

namespace App\Http\Response;


class JsonResponse extends Response
{
    public function __construct(int $status = 0, array $data = [])
    {
        parent::__construct($status, json_encode($data), ['Content-Type' => 'application/json']);
    }
}
