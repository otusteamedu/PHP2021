<?php
declare(strict_types=1);

namespace App\EmailVariation;

class EmailVariation
{
    private string $emailVar;
    private string $domain;

    public function __construct(string $email)
    {
        $this->emailVar = $this->testInput($email);
    }

    /***
     * Remove escaping characters
     *
     * @param string $data
     * @return string
     */
    private function testInput(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /***
     * Email Validation
     *
     * @param string $email
     * @return bool
     */
    private function emailValidation(string $email) : bool
    {
        $resValide = preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email);

        if(!$resValide){
            return false;
        }
        return true;
    }

    /***
     * Check DNS MX record
     *
     * @param string $email
     * @return bool
     */
    private function checkMX(string $email) : bool
    {
        $this->domain = substr($email, strrpos($email,'@')+1);
        $mx = array();
        $subString = getmxrr($this->domain, $mx);

        if(!$subString){
            return false;
        }

        return true;
    }

    public function run():void
    {
        try{
            if(!($this->emailValidation($this->emailVar))| !($this->checkMX($this->emailVar))){
                throw new \Exception('Ваш email не прошел варификацию.');
            }

            echo 'Ваш email прошел варификацию';

        }catch (\Exception $e){
            echo $e->getMessage().PHP_EOL;
        }

    }

}