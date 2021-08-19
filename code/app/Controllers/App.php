<?php

namespace Controllers;

class App
{
    public function run()
    {
        $_POST['false_string'] = '(()()()()))((((()()()))(()()()(((()))))))';
        $_POST['true_string'] = '(((())))';

        $value = $_POST['true_string'];

        $validator = new Validate();
        $result = $validator->isValidate($value);

        if ($result) {
            echo "Проверка прошла успешно";
        } else {
            header("HTTP/1.1 404 Not Found");
            echo "404";
        }

    }
}