<?php

namespace Src;

class App
{

    public function run(): void
    {
        $string = $_POST['string'];
        if (!empty($string) && $string[0] !== ')' && $string[strlen($string)-1] !== '('
            && (strrpos($string,'(') < strrpos($string,')'))) {
            $countBrackets = array_count_values(str_split($string));
            if ($countBrackets['('] === $countBrackets[')']) {
                header('HTTP/1.0 200 Ok');
                echo '200 Ok';
                exit();
            }
        }
        header('HTTP/1.0 400 Bad Request');
        echo '400 Bad Request';
    }
}