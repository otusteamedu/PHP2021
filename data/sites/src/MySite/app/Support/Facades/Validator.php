<?php

declare(strict_types=1);

namespace MySite\app\Support\Facades;


use JetBrains\PhpStorm\Pure;
use MySite\app\Support\Contracts\EntitiesConstants;
use MySite\app\Support\Contracts\RequestValidator;
use MySite\app\Support\Validators\DefaultValidator;
use MySite\app\Support\Validators\EndpointRequestValidator;

/**
 * Class Validator
 * @package MySite\app\Support\Facades
 */
class Validator
{

    /**
     * @param string $validator
     * @return RequestValidator
     */
    #[Pure] public static function make(string $validator): RequestValidator
    {
        return match ($validator) {
            EntitiesConstants::ENDPOINT => new EndpointRequestValidator(),
            default => new DefaultValidator()
        };
    }
}
