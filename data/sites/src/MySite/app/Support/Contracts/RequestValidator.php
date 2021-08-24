<?php


namespace MySite\app\Support\Contracts;


use MySite\app\Support\Dto\ValidatorResult;
use Psr\Http\Message\ServerRequestInterface;

interface RequestValidator
{

    /**
     * @param ServerRequestInterface $request
     * @return ValidatorResult
     */
    public function validate(ServerRequestInterface $request): ValidatorResult;
}
