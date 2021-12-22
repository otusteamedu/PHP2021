<?php
#Строгая типизация
declare(strict_types=1);

namespace App;

use App\Infrastructure\AnalyticSystems;
use App\Infrastructure\ParseJsonToRedis;
use App\Infrastructure\PredisTasks;

class App
{
    private int $param1;
    private int $param2;

    public function __construct(int $param1,int $param2){
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();


        $redis = new PredisTasks();
        $predis = $redis->getRedis();


        if(isset($predis)) {

            echo "Successfully connected to Redis". PHP_EOL;

            $predis->flushdb();

            /*
             * Чтение записей аналитика из файла и запись в Redis
             */
            $jsonToRedis = new ParseJsonToRedis();
            $jsonToRedis->run();


            /*
             * Запрос от пользователя. Результат
             */
            $request1 = new AnalyticSystems($this->param1,$this->param2);
            $request1->run();


        }else{
            echo "Error connected". PHP_EOL;
        }

    }
}
