<?php
declare(strict_types=1);

namespace App\Infrastructure\Controllers;

use App\Infrastructure\Models\Orders;
use App\Infrastructure\Components\DataValidation;
use Exception;

class OrderController
{

    public function actionTransactionAPI($fileJson) : void
    {
        //Валидация данных
        $resultDataValidation = new DataValidation();
        $resultDataValidation->setFileJson($fileJson);
        //$objectOrder = $resultDataValidation->run();


        try{
            $resultDataValidation->validateOrder();
            $objectOrder = $resultDataValidation->getObjectOrder();
        }catch (Exception $e){
             $errorMsg = $e->getMessage();
        } finally {

            //Проверка и запись данных при необходимости
            if(is_object($objectOrder)){
                $orderDB = new Orders();
                $order = $orderDB->insertNewOrder($objectOrder);

                $isRecordInDB = $orderDB->selectOrderIsPaid($objectOrder->getOrderNumber(),(float)$objectOrder->getSum());

                if($isRecordInDB){
                    http_response_code(200);
                    //header("HTTP/1.1 200 OK");
                    $result = '<span class="text-ok">Все хорошо</span>';
                }else{
                    //header("HTTP/1.1 403 Оплата не прошла");
                    http_response_code(403);
                    $result = '<span class="text-error">Оплата не прошла</span>';
                }

                $orderDB->deleteOrder($order);
            }else{
                //header("HTTP/1.1 400 Ошибка валидации");
                http_response_code(400);
                $result = '<span class="text-error">Ошибка валидации</span>';
            }
            //вывод результата
            require_once(ROOT.'src/Infrastructure/Views/result.php');
            echo PHP_EOL;
            var_dump(http_response_code());
        }


    }

}