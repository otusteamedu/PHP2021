<?php

declare(strict_types=1);

namespace App\Infrastructure;


class EmailValidate extends AbstractHandler
{

    /***
     * Email Validation
     *
     * @param string $email
     * @return ?string
     */

    public function handle(string $email): ?string
    {

        $res = (int)preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email);

        //надо отлавливать ошибку
        if($res != 1){
            throw new \Exception($email.' не прошел проверку на валидацию');
        }
        //echo 'Проверку на валидацию '.$email.' прошел'."\n";
        return parent::handle($email);

    }

}




