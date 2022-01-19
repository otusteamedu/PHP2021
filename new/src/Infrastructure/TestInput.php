<?php

declare(strict_types=1);

namespace App\Infrastructure;

class TestInput extends AbstractHandler
{
    /***
     * Check DNS MX record
     *
     * @param string $email
     * @return ?string
     */

    public function handle(string $email): ?string
    {
        $data = trim($email);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        if(!$data){
            throw new \Exception($email.' не прошел проверку на инъекции');
        }
        //echo 'Проверку на инъекции '.$email.' прошел.'."\n";
        return parent::handle($email);

    }
}