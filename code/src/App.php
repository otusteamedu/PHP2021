<?php
#Строгая типизация
declare(strict_types=1);

namespace App;

use App\Infrastructure\Result;

class App
{


    public function run(): void
    {
          //Получаем результат
          $result = new Result();
          $result->run();

    }
}
