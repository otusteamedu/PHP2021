<?php


namespace MySite\Http;


interface HttpCodes
{
    public const OK = 200;

    public const BAD_REQUEST = 400;

    public const NOT_FOUND = 404;

    public const FORBIDDEN = 403;

    public const SERVER_ERROR = 500;
}
