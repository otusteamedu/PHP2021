<?php

declare(strict_types=1);

namespace MySite\app\Support\Validators;


use JetBrains\PhpStorm\Pure;
use MySite\app\Support\Contracts\RequestValidator;
use MySite\app\Support\Dto\ValidatorResult;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class DefaultValidator
 * @package MySite\app\Support\Validators
 */
class DefaultValidator extends BaseValidator implements RequestValidator
{

    /**
     * @inheritDoc
     */
    #[Pure] public function validate(ServerRequestInterface $request): ValidatorResult
    {
        return new ValidatorResult();
    }
}
