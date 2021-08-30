<?php

namespace Project;

use Project\components\validator\DataValidator;

class App
{
    public function run(array $argv = []): bool|int
    {
        $isCorrectData = true;
        foreach ($_POST as $val) {
            $isCorrectData = $isCorrectData && DataValidator::isCorrectString($val);
        }

        return $isCorrectData ? http_response_code(200) : http_response_code(400);
    }
}