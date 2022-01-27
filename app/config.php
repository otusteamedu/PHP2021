<?php

use Src\service\CheckBracketsInterface;
use Src\service\CheckBrackets;
use function DI\create;

return [
    CheckBracketsInterface::class => create(CheckBrackets::class),
];
