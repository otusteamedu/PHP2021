<?php

declare(strict_types=1);

namespace MySite\domain\Support\Traits;

use Psr\Http\Message\ServerRequestInterface;
use stdClass;


/**
 * Class Tools
 * @package MySite\domain\Support\Traits
 */
trait Tools
{
    /**
     * @param ServerRequestInterface $request
     * @return stdClass|null
     */
    private static function parseJsonRequest(ServerRequestInterface $request): ?stdClass
    {
        return json_decode(
            json: $request
                      ->getBody()
                      ->getContents(),
            flags: JSON_THROW_ON_ERROR
        );
    }
}
