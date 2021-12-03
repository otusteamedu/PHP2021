<?php

namespace Vshepelev\App\Helpers;

class Str
{
    public static function contains(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) !== false;
    }
}
