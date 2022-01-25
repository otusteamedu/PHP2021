<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\IHandler;
use App\Infrastructure\TestInput;
use App\Infrastructure\EmailValidate;
use App\Infrastructure\RecordMX;


class App
{
    protected array $arrEmail;

    public function __construct()
    {
        //$this->emailVar = $this->getEmailVar();
    }
    /**
     * @return array
     */
    public function getEmailVar(): array
    {
        return $this->arrEmail;
    }

    /**
     * @param array $emailVar
     */
    public function setEmailVar(array $emailVar): void
    {
        $this->arrEmail = $emailVar;
    }


    private function clientCode(array $arrEmail,IHandler $handler){

        foreach($arrEmail as $email) {

            echo "Прохождение валидации для email: ".$email."?\n\n";
            try{
                $handler->handle($email);
                echo "Ошибок нет\n";
            }catch (\Exception $e){
                echo "Выброшено исключение: ",$e->getMessage(),"\n";
            }

           echo "========================\n\n";

        }

    }

    public function run():void
    {
        //Проверка на валидацию
        $testInput = new TestInput();
        $emailValidate = new EmailValidate();
        $recordMX = new RecordMX();

        $testInput->setNext($emailValidate)->setNext($recordMX);

        echo "Проверка массива email на валидацию: \n";
        print_r($this->getEmailVar())."\n\n";
        $this->clientCode($this->getEmailVar(),$testInput);

    }
}