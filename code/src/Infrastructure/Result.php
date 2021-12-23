<?php
#Строгая типизация
declare(strict_types=1);

namespace App\Infrastructure;

class Result
{
    private int $param1;
    private int $param2;

    //Параметры из командной строки
    public function __construct(){
        $this->param1 = (int) $_SERVER['argv'][1];
        $this->param2 = (int) $_SERVER['argv'][2];
    }


    public function connect(){
        $redis = new PredisTasks();
        $predis = $redis->getRedis();


        if(isset($predis)) {

            echo "Successfully connected to Redis". PHP_EOL;

            $predis->flushdb();

            $request1 = new AnalyticSystems($this->param1,$this->param2);
            $request1->run();

        }else{
            echo "Error connected". PHP_EOL;
        }

    }

    public function run(): void
    {
        $msg = '';

        //Проверка параметров
        if(isset($this->param1) && isset($this->param2)) {
            if (($this->param1 > 0 && $this->param2==0) ||
                ($this->param2 > 0 && $this->param1==0) ||
                ($this->param2 > 0 && $this->param1 > 0)){

                    //Получаем результат
                    $this->connect();

            }elseif ($this->param1 == 0 && $this->param2 == 0) {
                $msg .= 'Введите параметры'. PHP_EOL;
                echo $msg;
            }else{
                $msg .= "Ваши параметры param1={$this->param1}, param2={$this->param2}" . PHP_EOL;
                $msg .= "Введите параметры правильно: целые числа >= 0" . PHP_EOL;
                $msg .= "Если какого-то параметра нет, то он должен быть равен 0" . PHP_EOL;
                echo $msg;
            }
        }
    }

}