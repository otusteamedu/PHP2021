<?php

declare(strict_types=1);

namespace App\Infrastructure;

class RecordMX extends AbstractTemplate
{
    /***
     * Check DNS MX record
     *
     * @param string $email
     * @return bool
     */
    protected function checkEmail(string $email) : bool
    {
        $domain = substr($email, strrpos($email,'@')+1);
        $mx = array();
        return getmxrr($domain, $mx);
    }

}