<?php

use Src\service\CheckBracketsInterface;
use Src\service\CheckBrackets;
use Src\service\EchoResponse;
use Src\service\ResponseInterface;
use function DI\create;

return [
    CheckBracketsInterface::class => create(CheckBrackets::class),
    ResponseInterface::class => create(EchoResponse::class),
];
