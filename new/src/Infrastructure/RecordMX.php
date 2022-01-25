<?php

declare(strict_types=1);

namespace App\Infrastructure;

class RecordMX extends AbstractHandler
{
    /***
     * Check DNS MX record
     *
     * @param string $email
     * @return ?string
     */

    public function handle(string $email): void
    {
        $domain = substr($email, strrpos($email,'@')+1);
        $mx = array();
        $res = getmxrr($domain, $mx);

        if($res!=true){
            throw new \Exception($email.' не прошел проверку на RecordMX');
        }
        //return 'Проверку на RecordMX '.$email.' прошел'."\n";
        parent::handle($email);

    }

}