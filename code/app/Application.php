<?php

namespace App;

class Application
{
    private $request;
    private  $emailDog;

    public function __construct()
    {
        $this->request = $_POST;
    }

    public function run()
    {
        try{
            if(!($this->checkEmail($this->request['STRING'])) ||
                !($this->checkDnsMx($this->request['STRING']))){
                throw new \Exception("Верификация не пройдена.");
            }

            echo "Верификация пройдена.";

        }catch (\Exception $e){
            echo $e->getMessage().PHP_EOL;
        }
        echo "<h1>". $this->request['STRING']. "</h1>";
    }

    private function checkEmail(string $email) : bool
    {
        $resValide = preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email);
        if(!$resValide){
            return false;
        }
        return true;
    }

    private function checkDnsMx(string $email) : bool
    {
        $this->emailDog = substr($email, strrpos($email,'@')+1);
        $mx = array();
        $subString = getmxrr($this->emailDog, $mx);
        if(!$subString){
            return true;
        }

        return false;
    }

}