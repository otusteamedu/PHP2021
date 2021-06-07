<?php declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Interfaces\RequestInterface;

class RequestFactory
{
    public static function createFromGlobal(): RequestInterface
    {
        return  new Request($_POST, $_SERVER);
    }
}
