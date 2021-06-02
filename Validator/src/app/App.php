<?php

namespace App;

use App\Exceptions\EmptyDataException;
use App\Exceptions\IncorrectException;
use App\Exceptions\WrongMethodException;

class App
{
    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw new WrongMethodException();
        }
        if (empty($_POST) or empty($string = $_POST['string'])) {
            throw new EmptyDataException();
        }
        $bracketCounter = 0;
        $chars = str_split($string);

        if (!empty($chars)) {
            foreach ($chars as $char) {
                switch ($char) {
                    case '(':
                        $bracketCounter++;
                        break;
                    case ')':
                        $bracketCounter--;
                        break;
                }
                if ($bracketCounter < 0) {
                    throw new IncorrectException();
                }
            }
        }

        if (!$bracketCounter) {
            echo 'Correct';
        } else {
            throw new IncorrectException();
        }
    }
}
