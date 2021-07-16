<?php

namespace App\Http\Controllers;

use App\Exception\InvalidStringException;
use App\Http\Request;

class MessageController
{
    public function test(Request $request)
    {
        $data = $request->get('string');

        $arrStrings = str_split($data);
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

        if ($counter == 0) {
            header('HTTP/1.1 200 OK');
            echo json_encode([
                'response' => 'строка корректна',
            ]);
        } else {
            throw new InvalidStringException();
        }
    }
}