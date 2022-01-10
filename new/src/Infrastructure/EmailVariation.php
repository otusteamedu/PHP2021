<?php

declare(strict_types=1);

namespace App\Infrastructure;

class EmailVariation extends AbstractTemplate
{

    /***
     * Email Validation
     *
     * @param string $email
     * @return bool
     */
    protected function checkEmail(string $email) : bool
    {
        return (bool)preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email);
    }

}




