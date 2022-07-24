<?php

namespace App;

use Exception;

class RequestValidator
{
    /**
     * @param array $request
     * @return array
     * @throws Exception
     */
    public static function validate(array $request): array
    {
        if (!self::checkRequestType('POST')) {
            throw new Exception('Неверный метод запроса');
        }
        if (self::checkRequestIsEmpty($request)) {
            throw new Exception('Empty request');
        }

        return $request;
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function checkRequestType(string $type): bool
    {
        return ($_SERVER['REQUEST_METHOD'] === $type);
    }

    /**
     * @param array $request
     * @return bool
     */
    public static function checkRequestIsEmpty(array $request): bool
    {
        return empty($request);
    }
}