<?php
declare(strict_types=1);

namespace App\Source;

class Result
{
    public function connect($param1, $param2){
        $redis = new PredisTasks();
        $predis = $redis->getRedis();


        if(isset($predis)) {

            echo "Подключение к серверу redis успешно". PHP_EOL;

            $predis->flushdb();

            $request1 = new AnalyticSystems($param1, $param2);
            $request1->run();

        }else{
            echo "Ошибка подключения". PHP_EOL;
        }

    }

    public function run($param1, $param2): void
    {
        $msg = '';

        if(isset($param1) && isset($param2)) {
            if ($param2 > 0 || $param1 > 0){

                $this->connect($param1, $param2);

            }elseif ($param1 == 0 && $param2 == 0) {
                $msg .= 'Ввести параметры (целые числа) param1, param2 в get запросе'. PHP_EOL;
                echo $msg;
            }else{
                $msg .= "Ваши параметры param1={$param1}, param2={$param2}" . PHP_EOL;
                $msg .= "Необходимо ввести правильные значения" . PHP_EOL;
                echo $msg;
            }
        }
    }

}
