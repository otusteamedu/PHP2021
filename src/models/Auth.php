<?php

namespace App\Models;

class Auth
{
    /**
     *
     */
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

    /**
     * @param array $user
     */
    public function login(array $user)
    {
        $_SESSION[self::SESSION_INDEX_USER] = $user;
    }

    /**
     *
     */
    public function logout()
    {
        $_SESSION[self::SESSION_INDEX_USER] = null;
    }
}