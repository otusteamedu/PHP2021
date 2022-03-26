<?php

namespace App\Source;

class AnalyticSystems
{
    private int $param1;
    private int $param2;

    public function __construct($param1,$param2){
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    private function findEvent(){
        $predis = new PredisTasks();

        $arrRequest=[];
        $keys=[];
        $arrNameEvent=[];
        $arrPriority=[];

        $keys[1] = "param:1:{$this->param1}:param:2:{$this->param2}";
        $keys[2] = "param:1:{$this->param1}";
        $keys[3] = "param:2:{$this->param2}";

        echo "Соответствующие запросу события(param1={$this->param1},param2={$this->param2}):". PHP_EOL;

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
        if(empty($arrPriority)) echo 'Нет соответствий'. PHP_EOL;

        arsort($arrPriority);
        reset($arrPriority);

        return $arrNameEvent[key($arrPriority)];

    }

    private function resultRequest():void{
        $result = $this->findEvent();

        if(isset($result) && !empty($result)){
            echo PHP_EOL."Результат - По высшему приоритету подходит '{$result}'". PHP_EOL;
        }else{
            echo PHP_EOL."По вашему запросу ничего нет". PHP_EOL;
        }

    }

    public function run():void{

        $jsonToRedis = new ParseJsonToRedis();
        $valRes=$jsonToRedis->run();

        if($valRes===true){
            $this->resultRequest();
        }else{
            echo "Проблемы с аналитикой". PHP_EOL;
        }
    }

}