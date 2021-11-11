<?php

namespace Src\Cli;

class ColorCli
{
    private static array $textColor = [
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37',
    ];

    private static array $backgroundColor = [
        'black' => '40',
        'red' => '41',
        'green' => '42',
        'yellow' => '43',
        'blue' => '44',
        'magenta' => '45',
        'cyan' => '46',
        'light_gray' => '47',
    ];

    public function colorText(string $text, ?string $textColor = null, ?string $backgroundColor = null): string
    {
        $colorText = '';

        if (isset(self::$textColor[$textColor])) {
            $colorText .= "\033[" . self::$textColor[$textColor] . "m";
        }

        if (isset(self::$backgroundColor[$backgroundColor])) {
            $colorText .= "\033[" . self::$backgroundColor[$backgroundColor] . "m";
        }

        $colorText .= $text . "\033[0m";

        return $colorText;
    }
}
