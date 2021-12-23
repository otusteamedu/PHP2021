<?php
#Строгая типизация
declare(strict_types=1);

namespace App\Infrastructure;

class ParseJsonToRedis
{
    private array $arrRes=[];

    /*
     * Парсим массив строки из Json на переменные для дальнейшей записи в Redis
     */
    public function arrRec($arr): array
    {
        foreach ($arr as $key => $value) {

            if (is_array($value)) {
                $this->arrRec($value);
            } else {
                switch($key){
                    case "priority":
                        $this->arrRes['priority'] = $value;
                        break;
                    case "event":
                        $this->arrRes['event'] = $value;
                        break;
                    case "param1":
                        $this->arrRes['param1'] = $value;
                        break;
                    case "param2":
                        $this->arrRes['param2'] = $value;
                        break;
                }
            }
        }
        return $this->arrRes;
    }

    /*
     * Запись массива в Redis
     */
    private function addToRedis($arr):bool{
        //Создаем объект для работы с Redis
        $predis = new PredisTasks();

        //Запись в Redis
        foreach ($arr as $value){
            $arrData = json_decode($value,true);

            $this->arrRes = [];
            $key = '';
            $this->arrRec($arrData);

            if(!empty($this->arrRes['param1']) && !empty($this->arrRes['param2'])){
                $key = 'param:1:'.$this->arrRes['param1'].':param:2:'.$this->arrRes['param2'];
            }elseif(!empty($this->arrRes['param1']) && empty($this->arrRes['param2'])){
                $key = 'param:1:'.$this->arrRes['param1'];
            }elseif(empty($this->arrRes['param1']) && !empty($this->arrRes['param2'])){
                $key = 'param:2:'.$this->arrRes['param2'];
            }

            $priority = $this->arrRes['priority'];
            $event = $this->arrRes['event'];

            $predis->zAddRedis($key,$priority,$event);

        }

        return true;

    }

    /*
     * Результат записи из файла в Redis
     */
    private function resultParse():bool
    {
        //Файл с аналитикой
        $fileName = "./file/data.txt";

        if(file_exists($fileName)){
            //Получаем массив из строк json
            $arr = explode("\n",file_get_contents("./file/data.txt"));

            //Запись в Redis
            if(isset($arr)) {
                $resultParse = $this->addToRedis($arr);//return TRUE&&
            }else{
                $resultParse = false;
            }

        }else{
            $resultParse = false;
        }

        return $resultParse;;

    }

    /*
    * Чтение записей аналитика из файла и запись в Redis
    */
    public function run():bool{

        return $this->resultParse();
    }

}

