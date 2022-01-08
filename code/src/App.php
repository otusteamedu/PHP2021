<?php
#Строгая типизация
declare(strict_types=1);

namespace App;

use App\DataMapper;
use PDO;


class App
{


    public function run(): void
    {
        //Получаем результат

        $PDO = new PDO("pgsql:=localhost;dbname=demodb", "admin", "example");

        echo 'Привет'. PHP_EOL;
        //phpinfo();
        //$user = (new \App\DataMapper\UserMapper($PDO))->findById(1);
        //$user->getFirstName();

    }
}

