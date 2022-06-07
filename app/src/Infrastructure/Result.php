<?php

namespace Src\Infrastructure;

class Result
{
    private int $param1;
    private int $param2;

    public function __construct()
    {
        $this->param1 = (int) $_REQUEST['param1'];
        $this->param2 = (int) $_REQUEST['param2'];
    }

    /**
     * @return void
     */
    public function connect(): void
    {
        $redis = (new RedisTasks())->getRedis();

        if (isset($redis)) {
            echo "Соединение произошло успешно". PHP_EOL;

            $redis->flushdb();
            (new AnalyticSystem(
                $this->param1,
                $this->param2
            ))->run();
        } else {
            echo 'Ошибка соединения'. PHP_EOL;
        }
    }

    /**
     * @return void
     */
    public function run(): void
    {
        if ($this->param1 >= 0 && $this->param2 >= 0) {
            $this->connect();
        }
    }
}