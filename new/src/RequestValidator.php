<?php

namespace Src;

class RequestValidator
{
    /**
     * @param string $type
     * @return bool
     */
    public static function isNeedRequestType(string $type): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $type;
    }

    /**
     * @param array $request
     * @return bool
     */
    public static function isEmpty(array $request): bool
    {
        return empty($request);
    }
}