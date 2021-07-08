<?php


namespace App\http;

use App\http\handlerRequest;


class httpRequest
{


    static string $postParam = "stringBrackets";

    function checkBrackets():bool{

        if (  empty($_POST[self::$postParam]) ){

            return false;

        }

        return true;

    }



    function checkMethod():bool{

        if ( $_SERVER['REQUEST_METHOD'] == "POST" ){

            return true;

        }
            return false;


    }


    public function getHttpBody():string{

        return $_POST[self::$postParam];

    }


}