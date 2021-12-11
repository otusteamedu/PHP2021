<?php

declare(strict_types=1);

namespace Vshepelev\App\Controllers;

use Vshepelev\App\Request;
use Vshepelev\App\Response\Response;
use Vshepelev\App\Response\HttpStatus;

class BracketsController
{
    public function check(Request $request): Response
    {
        // Validation
        if (!$string = $request->input('string')) {
            return new Response("Field 'string' is not found", HttpStatus::UNPROCESSABLE_ENTITY);
        }

        if (empty($string)) {
            return new Response("Field 'string' must be not empty", HttpStatus::UNPROCESSABLE_ENTITY);
        }

        // Handle request
        preg_match('/(?:\((?R)\))*/', $string, $matches);

        if (!isset($matches[0]) || $matches[0] !== $string) {
            return new Response('Incorrect string', HttpStatus::UNPROCESSABLE_ENTITY);
        }

        return new Response('Correct string');
    }
}
