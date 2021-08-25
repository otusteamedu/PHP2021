<?php

declare(strict_types=1);

namespace MySite\app\Support\Validators;


use Psr\Http\Message\ServerRequestInterface;
use stdClass;

class BaseValidator
{

    /**
     * @param ServerRequestInterface $request
     * @return stdClass|null
     */
    protected function parseJsonRequest(ServerRequestInterface $request): ?stdClass
    {
        return json_decode(
            $request
                ->getBody()
                ->getContents()
        );
    }
}
