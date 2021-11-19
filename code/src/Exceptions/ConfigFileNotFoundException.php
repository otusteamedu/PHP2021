<?php

namespace Elastic\Exceptions;

class ConfigFileNotFoundException extends \Exception
{
    protected $message = "Config file not found";
}
