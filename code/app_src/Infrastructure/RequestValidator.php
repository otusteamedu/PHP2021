<?php

namespace App\Infrastructure;

use Exception;

class RequestValidator
{
	private static array $requiredFields = [
		'client_id', 'client_email',
	];
	
	public static function validateRequest(array $request): array
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
