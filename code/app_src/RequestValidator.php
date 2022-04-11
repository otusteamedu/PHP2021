<?php

namespace App;

class RequestValidator
{
    public static function validate(array $request): array
    {
		if (!self::checkRequestType('POST')) {
			throw new \Exception('Wrong request method');
		}
		if (self::checkRequestIsEmpty($request)) {
			throw new \Exception('Empty request');
		}
		
		return $request;
    }

    public static function checkRequestType(string $typeNeeded): bool
    {
        return $_SERVER['REQUEST_METHOD'] == $typeNeeded ? true : false;
    }

    public static function checkRequestIsEmpty(array $request): bool
    {
        return empty($request) ? true : false;
    }
}
