<?php

namespace App\parser;

interface parseSourceInterface
{
    public function parseEmailSource(emailSource $emailSource):array;
}