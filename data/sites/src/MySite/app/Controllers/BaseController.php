<?php

declare(strict_types=1);

namespace MySite\app\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use stdClass;

/**
 * Class BaseController
 * @package MySite\app\Controllers
 */
class BaseController
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
