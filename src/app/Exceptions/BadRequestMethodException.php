<?php

namespace Ivanboriev\TrustedBrackets\Exceptions;

class BadRequestMethodException extends \Exception
{
    public $message = 'Bad request method! Available methods: [POST]';
}