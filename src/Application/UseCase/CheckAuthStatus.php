<?php

namespace App\Application\UseCase;


use App\Application\Services\CheckAuthStatusInterface;

class CheckAuthStatus implements CheckAuthStatusInterface
{

    const SESSION_INDEX_USER = 'user';

    /**
     * @return array|null
     */
    public function user()
    {
        return $_SESSION[self::SESSION_INDEX_USER];
    }

    /**
     * @return bool
     */
    public function quest()
    {
        return empty($_SESSION[self::SESSION_INDEX_USER]);
    }
}