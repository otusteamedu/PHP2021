<?php

namespace App\Infrastructure;

class Response
{
	public static function generateOkResponse($responseText)
	{
		header('HTTP/1.0 200 Ok');
		echo $responseText.PHP_EOL;
	}

	public static function generateBadRequestResponse($responseText)
	{
		header('HTTP/1.0 400 Bad Request');
		echo $responseText.PHP_EOL;
	}
}
