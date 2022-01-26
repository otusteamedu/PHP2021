<?php
declare(strict_types=1);

namespace App\Infrastructure\Components;

use Exception;

class DataValidation
{
    protected string $fileJson;
    protected Order $objectOrder;



    /**
     * @return Order
     */
    public function getObjectOrder(): Order
    {
        return $this->objectOrder;
    }

    /**
     * @param Order $objectOrder
     */
    public function setObjectOrder(Order $objectOrder): void
    {
        $this->objectOrder = $objectOrder;
    }

    /**
     * @return string
     */
    public function getFileJson(): string
    {
        return $this->fileJson;
    }

    /**
     * @param string $fileJson
     */
    public function setFileJson(string $fileJson): void
    {
        $this->fileJson = $fileJson;
    }


    private function parseJSONtoObject(string $file): Order
    {
        $ourData = file_get_contents($file);
        $objectData = json_decode($ourData);

        return new Order(
            (int) 1,
            (string) $objectData->card_number,
            (string) $objectData->card_holder,
            (string) $objectData->card_expiration,
            (string) $objectData->cvv,
            (string) $objectData->order_number,
            (string) $objectData->sum
        );

    }


    private function checkCardNumber(string $cardNumber) : bool
    {
        $result = preg_match('/^[0-9]{16}$/',trim($cardNumber));

        if (!$result) throw new \Exception('Номер карты не верный');

        return true;
    }


    private function checkCardHolder(string $cardHolder) : bool
    {
        $result = preg_match('/[^A-Za-z-]/',trim($cardHolder));

        if (!$result) throw new \Exception('Имя и фамилия не корректы');

        return true;
    }


    private function checkCardExpiration(string $cardExpiration) : bool
    {

        $s = preg_match('/^(0[1-9]|1[012])\/\d{2}$/',trim($cardExpiration));
        $result=false;

        if($s) {
            $testData = explode('/',$cardExpiration);

            $checkDate = (checkdate((int)$testData[0],10,(int)$testData[1]));

            $result =  ((int)$testData[0]>=date("m")) && ((int)$testData[1]>=date("y")) && ($checkDate === true);

        }

        if(!$result) throw new \Exception('Введите корректные месяц/год окончания карты в формате мм/гг. ');

        return true;
    }


    private function checkCvv(string $cvv) : bool
    {
        $result = preg_match('/^[0-9][0-9][0-9]/',trim($cvv));

        if (!$result) throw new \Exception('Код состоит из 3 цифр от 0 до 9');

        return true;
    }

    private function checkOrderNumber(string $orderNumber) : bool{
        $s = strlen(trim($orderNumber));
        $result = ($s>0 && $s<=16)?'true':'false';

        if (!$result) throw new \Exception('Код состоит до 16 произвольных символов');

        return true;
    }


    private function checkSum(string $sum) : bool
    {

        $result = preg_match('/^[0-9]{1,8}\,[0-9]{2}/',$sum);

        if (!$result) throw new \Exception('Для разделителя используйте запятую');

        return true;
    }

    public function validateOrder() : bool
    {
        //Get object from Json
        $order = $this->parseJSONtoObject($this->getFileJson());
        $this->setObjectOrder($order);
        $order = $this->getObjectOrder();

        $arr = ['CardNumber','CardHolder','CardExpiration','Cvv','OrderNumber','Sum'];
        $i = 0;

        do {
            $method = 'check'.$arr[$i];
            $param = 'get'.$arr[$i];

            $this->$method($order->$param());
            $i++;

        }while( $i<count($arr));

        return true;
    }

    public function run() : ? Order
    {
        //Get object from Json
        $order = $this->parseJSONtoObject($this->getFileJson());
        $this->setObjectOrder($order);

        //try{
            //Проверка на валидацию
         //   $resultValidate =$this->validateOrder($this->getObjectOrder());

           // if(!$resultValidate) return ;

        //}catch (Exception $e){
        //   echo $e->getMessage().PHP_EOL;
       // }

        return $this->getObjectOrder();
    }


}