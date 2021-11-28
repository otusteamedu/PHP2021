<?php

namespace App;

class Validation
{
    public static function run($request){
        try{
            if(!(self::checkEmail($request)) ||
                !(self::checkDnsMx($request))){
                throw new \Exception("Верификация не пройдена.");
            }
            else{
                throw new \Exception("Верификация пройдена.");
            }

        }catch (\Exception $e){
            echo $e->getMessage().PHP_EOL;
        }

    }
    private static function checkEmail(string $email) : bool
    {
        $resValide = preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email);
        if(!$resValide){
            return false;
        }
        return true;
    }

    private static function checkDnsMx(string $email) : bool
    {
        $emailDog = substr($email, strrpos($email,'@')+1);
        $mx = array();
        $subString = getmxrr($emailDog, $mx);
        if(!$subString){
            return true;
        }

        return false;
    }
}