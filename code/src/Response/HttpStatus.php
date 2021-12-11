<?php

declare(strict_types=1);

namespace Vshepelev\App\Response;

enum HttpStatus: int
{
    case OK = 200;
    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case UNPROCESSABLE_ENTITY = 422;
    case SERVER_ERROR = 500;
}
