<?php

namespace Validator;

class HttpJson implements ReturnAnswer
{
    public function success()
    {
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        $result = [
            'status' => 'Успешно',
            'message' => 'Данные указаны корректно!'
        ];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function failed(string $error)
    {
        header("HTTP/1.1 400 Bad Request");
        header('Content-Type: application/json');
        $result = [
            'status' => 'Ошибка!',
            'message' => $error
        ];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}