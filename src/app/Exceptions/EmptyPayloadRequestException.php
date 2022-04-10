<?php

namespace Ivanboriev\TrustedBrackets\Exceptions;

class EmptyPayloadRequestException extends \Exception
{
    public $message = 'Empty payload request!';
}