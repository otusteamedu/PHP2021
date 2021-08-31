<?php

namespace Project\app;

use Project\components\validator\DataValidator;

class WebApp
{
    public function run(): bool|int
    {
        $isCorrectData = true;
        foreach ($_POST as $val) {
            $isCorrectData = $isCorrectData && DataValidator::isCorrectString($val);
        }

        return $isCorrectData ? http_response_code(200) : http_response_code(400);
    }
}