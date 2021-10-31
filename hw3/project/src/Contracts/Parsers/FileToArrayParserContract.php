<?php

namespace App\Contracts\Parsers;


interface FileToArrayParserContract
{
    public function parse(): array;
}
