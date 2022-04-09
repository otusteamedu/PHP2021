<?php
declare(strict_types=1);

namespace App\Source;

class Result
{
    private int $param1;
    private int $param2;
    private object $redis;

    public function __construct()
    {
        $this->param1 = (int) $_REQUEST['param1'];
        $this->param2 = (int) $_REQUEST['param2'];
    }
    public function connect(){
        $this->redis = new PredisTasks();
        $predis = $this->redis->getRedis();


        if(isset($predis)) {

            echo "Подключение к серверу redis успешно". PHP_EOL;

            $predis->flushdb();

            $jsonToRedis = new ParseJsonToRedis();
            $valRes=$jsonToRedis->run();

            if($valRes===true){
                $this->resultRequest();
            }else{
                echo "Проблемы с аналитикой". PHP_EOL;
            }

        }else{
            echo "Ошибка подключения". PHP_EOL;
        }

    }

    public function run(): void
    {
        $msg = '';

        if(isset($this->param1) && isset($this->param2)) {
            if ($this->param2 > 0 || $this->param1 > 0){

                $this->connect();

            }elseif ($this->param1 == 0 && $this->param2 == 0) {
                $msg .= 'Ввести параметры (целые числа) param1, param2 в get запросе'. PHP_EOL;
                echo $msg;
            }else{
                $msg .= "Ваши параметры param1={$this->param1}, param2={$this->param2}" . PHP_EOL;
                $msg .= "Необходимо ввести правильные значения" . PHP_EOL;
                echo $msg;
            }
        }
    }

    private function resultRequest():void{
        $result = $this->findEvent();

        if(isset($result) && !empty($result)){
            echo PHP_EOL."Результат - По высшему приоритету подходит '{$result}'". PHP_EOL;
        }else{
            echo PHP_EOL."По вашему запросу ничего нет". PHP_EOL;
        }

    }
    private function findEvent(){


        $arrRequest=[];
        $keys=[];
        $arrNameEvent=[];
        $arrPriority=[];

        $keys[1] = "param:1:{$this->param1}:param:2:{$this->param2}";
        $keys[2] = "param:1:{$this->param1}";
        $keys[3] = "param:2:{$this->param2}";

        echo "Соответствующие запросу события(param1={$this->param1},param2={$this->param2}):". PHP_EOL;

        for($i=1;$i<=count($keys);$i++){
            $arrRequest[$i] = $this->redis->zRevRangeByScoreRedis($keys[$i]);

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

}
