<?php

namespace App\Http;

use App\Exception\EmptyParamsException;
use App\Exception\InvalidMethodException;
use App\Exception\InvalidStringException;


class App
{
    /**
     * @throws InvalidMethodException
     * @throws EmptyParamsException
     * @throws InvalidStringException
     */

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw  new InvalidMethodException();
        }
        if (empty($_POST) || empty($_POST['string'])) {
            throw new EmptyParamsException();
        }

        $string = $_POST['string'];
        $arrStrings = str_split($string);
        $counter = 0;

        if ($arrStrings[0] == ")") throw new InvalidStringException();

        for ($i = 0; $i < count($arrStrings); $i++) {
            if ($arrStrings[$i] == '(') {
                $counter++;
            } elseif ($arrStrings[$i] == ')') {
                $counter--;
            }
            if ($counter < 0) break;
        }
        if ($counter === 0) {
            header('HTTP/1.1 200 OK');
            echo 'ОК';
        } else {
            throw new InvalidStringException();
        }
    }
}
