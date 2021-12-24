<?php

use App\Contract\ValidatorInterface;
use App\UseCase\BracketValidator;

return [
    ValidatorInterface::class => DI\get(BracketValidator::class),
];
