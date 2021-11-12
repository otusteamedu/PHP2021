<?php

namespace App\Services;

class CommonHelpers
{
    public static function clearPairedBrackets(string $target, string $mode = ''): string
    {
        $source = $target;

        do {
            $stepResult = str_replace('()', '', $source);

            if ($mode === 'cli') {
                echo sprintf('%s -> %s', $source, $stepResult) . PHP_EOL;                
            }

            $needStop = ($source === $stepResult) || ($stepResult === '');

            $source = $stepResult;

        } while (! $needStop);

        return $stepResult;
    }
}
