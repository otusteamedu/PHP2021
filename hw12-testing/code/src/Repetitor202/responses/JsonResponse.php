<?php

namespace Repetitor202\responses;

use Laminas\Diactoros\Response;

class JsonResponse
{
    public static function responseWithStatus(int $status, array $data = [])
    {
        $response = new Response();

        if (!empty($data)) {
            $response->getBody()->write(json_encode($data));
        }

        return $response->withStatus($status);
    }
}