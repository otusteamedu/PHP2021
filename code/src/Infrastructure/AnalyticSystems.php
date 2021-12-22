<?php

namespace App\Infrastructure;

use App\Infrastructure\PredisTasks;

class AnalyticSystems
{
    private int $param1;
    private int $param2;

    public function __construct(int $param1,int $param2){
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    /*
     * Функция поиска подходящего события по запросу пользователя
     */
    private function findEvent(){
        //Создаем объект для работы с Redis
        $predis = new PredisTasks();

        $arrRequest=[];
        $keys=[];
        $arrNameEvent=[];
        $arrPriority=[];

        $keys[1] = "param:1:{$this->param1}:param:2:{$this->param2}";
        $keys[2] = "param:1:{$this->param1}";
        $keys[3] = "param:2:{$this->param2}";

        echo "Соответствующие запросу события:". PHP_EOL;

        //Запросы в Redis по ключам
        for($i=1;$i<=count($keys);$i++){
            $arrRequest[$i] = $predis->zRevRangeByScoreRedis($keys[$i]);

            if (is_array($arrRequest[$i])) {
                foreach ($arrRequest[$i] as $value => $key) {
                    echo $value . ' - приоритет:' . $key . PHP_EOL;
                    $arrNameEvent[$i]=$value;
                    $arrPriority[$i]=(int)$key;
                }
            }
        }

        arsort($arrPriority);
        reset($arrPriority);

        return $arrNameEvent[key($arrPriority)];

    }

    public function run(){

        $result = $this->findEvent();
        echo PHP_EOL;
        echo "Результат - По высшему приоритету подходит '{$result}'". PHP_EOL;


    }

}