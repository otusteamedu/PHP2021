<?php
#Строгая типизация
declare(strict_types=1);


namespace App;

use App\DataMapper\UserMapper;
use App\System\Config;


class App
{


    public function run(): void
    {
        // Make a database connection
        $connect = new Config();
        $pdo = $connect->run();

        //Add new user
        $user = new UserMapper($pdo);

        $userArray = array(
            'first_name' => 'Алина',
            'last_name' =>'Минякова',
            'age' => 27,
            'email' => 'ifhv94@mail.ru',
            'status_student' => 1
        );

        try {
            $idUser1 = $user->insert($userArray)->getId();

            //User search end message
            $nameUser1 = $user->findById($idUser1);

            $msg = 'Здравствуйте, '.$nameUser1->getFirstName().' '.$nameUser1->getLastName().'!'. PHP_EOL;
            $msg .= 'Ваш mail: '.$nameUser1->getEmail(). PHP_EOL. PHP_EOL;

            echo $msg;

            //User delete
            $user->delete($nameUser1);
        } catch (PDOException $e) {
            die($e->getMessage());
        }


    }

}

