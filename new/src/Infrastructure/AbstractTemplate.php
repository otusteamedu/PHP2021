<?php

declare(strict_types=1);

namespace App\Infrastructure;

abstract class AbstractTemplate
{
    private string $emailVar;

    public function __construct(string $email)
    {
        $this->emailVar = $this->testInput($email);
    }

    /***
     * Removing extra characters from the string
     *
     * @param string $data
     * @return string
     */
    protected function testInput(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    /***
     * Output of the result
     *
     * @return void
     */
    public function run():void
    {
        try{
            if(!($this->checkEmail($this->emailVar))){
                throw new \Exception('Ваш email не прошел варификацию.');
            }
            echo 'Ваш email прошел варификацию'.PHP_EOL;

        }catch (\Exception $e){
            echo $e->getMessage().PHP_EOL;
        }

    }

    /***
     * Validation of the Email
     *
     * @param string $email
     * @return bool
     */
    protected abstract function checkEmail(string $email) : bool;
}