<?php

namespace Controllers;

class App
{
    public function run($request)
    {
        $validator = new Validate();
        $result = $validator->isValidate($request);

        if ($result) {
            echo "Проверка прошла успешно";
        } else {
            echo "404";
        }

    }
}